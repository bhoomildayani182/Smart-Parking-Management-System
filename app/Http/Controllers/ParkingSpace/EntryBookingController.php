<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Constants\IBDConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\EntryBookingRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\DriverAndCleaner;
use App\Models\EntryBooking;
use App\Models\ParkingSlotDetails;
use App\Models\Slot;
use App\Models\State;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EntryBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bookings = EntryBooking::with('vehicle:vehicle_number,id', 'slot:start_time,end_time,duration,id')->where('status', '!=' , IBDConstants::BookingStatus["EXIT"])->paginate(10);
            return view('parking_space.entry_booking.index', [
                'bookings' => $bookings
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $country = Country::where('name', 'India')->first();
            $states = State::where('country_id', $country->id)->pluck('name', 'id')->toArray();
            $cities = City::select('state_id','name', 'id')->get()->toArray();
            $slots = Slot::select(DB::raw("CONCAT(start_time, ' - ', end_time, ' - ', duration) as slot_time"), 'id')->pluck("slot_time", "id")->toArray();
            $vehicle_models = VehicleModel::select(DB::raw("CONCAT(maker_name, '-' ,company_name) as vehicle_model"), 'id')->pluck("vehicle_model", "id")->toArray();
            $parking_space = ParkingSlotDetails::where('is_booked', '!=', 1)->pluck('space_name', 'id')->toArray();
            $payment_mode = ['ONLINE' => 'Online', 'OFFLINE' => 'Offline'];
            $documentType = ["Adharcard" => "Aadhar Card", "DrivingLicense" => "Driving License"];
            return view('parking_space.entry_booking.create',[
                'states' => $states,
                'cities' => $cities,
                'slots' => $slots,
                'vehicle_models' => $vehicle_models,
                'parking_space' => $parking_space,
                'payment_mode' => $payment_mode,
                'document_type' => $documentType
            ]);
        } catch (Exception $e){
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntryBookingRequest $request)
    {
        try {
            
            DB::beginTransaction();
            $cleanerStartFrom = 0;
            if(!isset($request->old_cleaner_id)) {
                $request->old_cleaner_id = [];
            }
            if(!isset($request->old_driver_id)){
                $cleanerStartFrom = 1;
                $stateDriver = State::select('name')->where('id', $request->state_id[0])->first();
                $cityDriver = City::select('name')->where('id', $request->city_id[0])->first();
    
                $fileLocation = "DriverAndCleanerDocuments/" . time() . "-" . $request->document[0]->GetClientOriginalName();
                Storage::disk('public')->put($fileLocation, file_get_contents($request->document[0]));
    
                $driver = DriverAndCleaner::create([
                    'name' => $request->name[0],
                    'mobile' => $request->mobile[0],
                    'Gender' => "MALE",
                    'address' => $request->address[0],
                    'city' => $cityDriver->name,
                    'state' => $stateDriver->name,
                    'country' => "India",
                    'designation' => "DRIVER",
                    'is_active' => true,
                    'document_file_id' => $fileLocation,
                    'document_number' => $request->document_number[0],
                    'document_type' => $request->document_type[0],
                    'created_by' => $request->user()->id,
                    'created_at' => Carbon::now()
                ]);
            } else {
                $driver =DriverAndCleaner::where('id', $request->old_driver_id)->first();
            }

            if(isset($request->name)){

                for ($i = $cleanerStartFrom; $i < count($request->name); $i++) {

                    $fileLocation = "DriverAndCleanerDocuments/" . time() . "-" . $request->document[$i]->GetClientOriginalName();
                    Storage::disk('public')->put($fileLocation, file_get_contents($request->document[$i]));

                    $state = State::select('name')->where('id', $request->state_id[$i])->first();
                    $city = City::select('name')->where('id', $request->city_id[$i])->first();

                    $cleaner = DB::table('driver_and_cleaner')->insertGetId([
                        'name' => $request->name[$i],
                        'mobile' => $request->mobile[$i],
                        'Gender' => "MALE",
                        'address' => $request->address[$i],
                        'city' => $city->name,
                        'state' => $state->name,
                        'country' => "India",
                        'designation' => "CLEANER",
                        'is_active' => true,
                        'document_file_id' => $fileLocation,
                        'document_number' => $request->document_number[$i],
                        'document_type' => $request->document_type[$i],
                        'created_by' => $request->user()->id,
                        'created_at' => Carbon::now()
                    ]);
                    array_push($request->old_cleaner_id, $cleaner);
                }
            }

            $vehicle = Vehicle::where('vehicle_number', $request->vehicle_number)->first();

            if($vehicle) {

                $vehicle->update([
                    'vehicle_model_id' => $request->vehicle_model_id,
                    'driver_id' => $driver->id,
                    'cleaner_id' => json_encode($request->old_cleaner_id),
                ]);
                $vehicle = $vehicle->id;

            } else {
                
                $vehicle = DB::table('vehicle')->insertGetId([
                    'vehicle_model_id' => $request->vehicle_model_id,
                    'vehicle_number' => strtoupper($request->vehicle_number),
                    'driver_id' => $driver->id,
                    'cleaner_id' => json_encode($request->old_cleaner_id),
                    'city' => $cityDriver->name,
                    'state' => $stateDriver->name,
                    'country' => "India",
                    'created_by' => $request->user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }


            ParkingSlotDetails::where('id', $request->parking_space_id)->update([
                'is_booked' => true
            ]);

            $slotPrice = DB::table('slot_pricing')->where('slot_id', $request->slot_id)->where('vehicle_model_id', $request->vehicle_model_id)->first();
            EntryBooking::create([
                'slot_id' => $request->slot_id,
                'slot_pricing_id' => $slotPrice->id,
                'vehicle_model_id' => $request->vehicle_model_id,
                'price' => $slotPrice->price,
                'vehicle_id' => $vehicle,
                'driver_id' => $driver->id,
                'payment_mode' => $request->payment_mode,
                'driver_name' => $driver->name,
                'parking_id' => $request->user()->default_parking_id,
                'parking_space_id' => $request->parking_space_id,
                'number_of_peron' => count($request->old_cleaner_id) + 1,
                'status' => IBDConstants::BookingStatus['ENTRY'],
                'entry_time' => Carbon::now(),
                'date' => Carbon::now()->format('Y-m-d'),
                'created_by' => $request->user()->id
            ]);

            DB::commit();

            toastr()->success('Vehicle Enter successfully!');
            return redirect()->route('entry-booking.create')->with('message', 'City added successfully');

        } catch (Exception $e) {
            DB::rollBack();
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EntryBooking $entryBooking)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($entryBooking)
    {
        try{
            $entry_booking = EntryBooking::with('vehicle:vehicle_number,id,cleaner_id','driver')->where('id', $entryBooking)->first();
            $cleaners = DriverAndCleaner::whereIn('id', json_decode($entry_booking->vehicle->cleaner_id))->get();
            $country = Country::select('id')->where('name', 'India')->first();
            $states = State::where('country_id', $country->id)->pluck('name', 'id')->toArray();
            $cities = City::select('state_id','name', 'id')->get()->toArray();
            $slots = Slot::pluck(DB::raw("CONCAT(start_time, ' - ', end_time, ' - ', duration) as slot_time"), 'id')->toArray();
            $vehicle_models = VehicleModel::pluck(DB::raw("CONCAT(maker_name, '-' ,company_name) as vehicle_model"), 'id')->toArray();
            $parking_space = ParkingSlotDetails::pluck('space_name', 'id')->toArray();
            $payment_mode = ['ONLINE' => 'Online', 'OFFLINE' => 'Offline'];
            $documentType = ["Adharcard" => "Aadhar Card", "DrivingLicense" => "Driving License"];
            return view('parking_space.entry_booking.update',[
                'entry_booking' => $entry_booking,
                'cleaners' => $cleaners,
                'states' => $states,
                'cities' => $cities,
                'slots' => $slots,
                'vehicle_models' => $vehicle_models,
                'parking_space' => $parking_space,
                'payment_mode' => $payment_mode,
                'document_type' => $documentType,
            ]);
        } catch (Exception $e){
            DB::rollBack();
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntryBookingRequest $request, EntryBooking $entry_booking)
    {
        try {
            DB::beginTransaction();

            $stateDriver = State::select('name')->where('id', $request->driver_state_id)->first();
            $cityDriver = City::select('name')->where('id', $request->driver_city_id)->first();

            $updateField = [
                'name' => $request->driver_name,
                'mobile' => $request->driver_mobile,
                'address' => $request->driver_address,
                'state' => $stateDriver->name,
                'city' => $cityDriver->name,
                'mobile' => $request->driver_mobile,
                'document_type' => $request->driver_document_type,
                'document_number' => $request->driver_document_number,
                'updated_by' => $request->user()->id
            ];

            if(isset($request->driver_document)) {
                $fileLocation = "ParkingDocuments/" . time() . "-" . $request->driver_document->GetClientOriginalName();
                Storage::disk('public')->put($fileLocation, file_get_contents($request->driver_document));

                $updateField = array_merge($updateField, ['document_file_id' => $fileLocation]);
            }

            DriverAndCleaner::where('id', $entry_booking->driver_id)->update($updateField);

            $cleanerIds = Vehicle::select('cleaner_id')->where('id', $entry_booking->vehicle_id)->first();

            DriverAndCleaner::whereIn('id', json_decode($cleanerIds->cleaner_id))->whereNotIn('id', $request->cleaner_id)->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);

            $cleaners = $request->cleaner_id;
            for ($i = 0; $i < count($request->cleaner_id); $i++) {
                $state = State::select('name')->where('id', $request->state_id[$i])->first();
                $city = City::select('name')->where('id', $request->city_id[$i])->first();

                $updateField = [
                    'name' => $request->name[$i],
                    'mobile' => $request->mobile[$i],
                    'Gender' => "MALE",
                    'address' => $request->address[$i],
                    'city' => $city->name,
                    'state' => $state->name,
                    'country' => "India",
                    'designation' => "CLEANER",
                    'document_number' => $request->document_number[$i],
                    'document_type' => $request->document_type[$i],
                    'is_active' => true,
                    'updated_by' => $request->user()->id,
                    'updated_at' => Carbon::now()
                ];

                if(array_key_exists($request->cleaner_id[$i], $request->document)){
                    $fileLocation = "ParkingDocuments/" . time() . "-" . $request->document[$request->cleaner_id[$i]]->GetClientOriginalName();

                    Storage::disk('public')->put($fileLocation, file_get_contents($request->document[$request->cleaner_id[$i]]));
                    $updateField = array_merge($updateField, ['document_file_id' => $fileLocation]);
                }
                DB::table('driver_and_cleaner')->where('id', $request->cleaner_id[$i])->update($updateField);
            }
            if(count($request->cleaner_id) < count($request->name)){

                for ($i = count($request->cleaner_id), $j = 0; $i < count($request->name); $i++, $j++) {

                    $state = State::select('name')->where('id', $request->state_id[$i])->first();
                    $city = City::select('name')->where('id', $request->city_id[$i])->first();

                    $fileLocation = "ParkingDocuments/" . time() . "-" . $request->new_document[$j]->GetClientOriginalName();
                    Storage::disk('public')->put($fileLocation, file_get_contents($request->new_document[$j]));

                    $cleaner = DB::table('driver_and_cleaner')->insertGetId([
                        'name' => $request->name[$i],
                        'mobile' => $request->mobile[$i],
                        'Gender' => "MALE",
                        'address' => $request->address[$i],
                        'city' => $city->name,
                        'state' => $state->name,
                        'country' => "India",
                        'designation' => "CLEANER",
                        'document_number' => $request->document_number[$i],
                        'document_type' => $request->document_type[$i],
                        'document_file_id' => $fileLocation,
                        'is_active' => true,
                        'created_by' => $request->user()->id,
                        'created_at' => Carbon::now()
                    ]);

                    $cleaners[] = $cleaner;
                }

            }


            Vehicle::where('id', $entry_booking->vehicle_id)->update([
                'vehicle_model_id' => $request->vehicle_model_id,
                'vehicle_number' => strtoupper($request->vehicle_number),
                'cleaner_id' => json_encode($cleaners),
                'city' => $cityDriver->name,
                'state' => $stateDriver->name,
                'country' => "India",
                'updated_by' => $request->user()->id
            ]);

            if($request->parking_space_id != $entry_booking->parking_space_id) {

                ParkingSlotDetails::where('id', $request->parking_space_id)->update([
                    'is_booked' => true
                ]);

                ParkingSlotDetails::where('id', $entry_booking->parking_space_id)->update([
                    'is_booked' => false
                ]);
            }

            $slotPrice = DB::table('slot_pricing')->select('id', 'price')->where('slot_id', $request->slot_id)->where('vehicle_model_id', $request->vehicle_model_id)->first();

            $entry_booking->update([
                'slot_id' => $request->slot_id,
                'slot_pricing_id' => $slotPrice->id,
                'vehicle_model_id' => $request->vehicle_model_id,
                'price' => $slotPrice->price,
                'payment_mode' => $request->payment_mode,
                'driver_name' => $request->driver_name,
                'parking_space_id' => $request->parking_space_id,
                'number_of_peron' => count($request->name) + 1,
                'status' => IBDConstants::BookingStatus['ENTRY'],
                'updated_by' => $request->user()->id
            ]);

            DB::commit();
            toastr()->success('Vehicle Entered Updated successfully!');
            return redirect()->route('entry-booking.index')->with('message', 'City added successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntryBooking $entry_booking, Request $request)
    {
        try {

            $entry_booking->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);
            toastr()->success('Vehicle Entered Delete successfully!');
            return redirect()->route('entry-booking.index')->with('message', 'City deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    public function get_price($vehicle, $slot){
        try{
            $slotPrice = DB::table('slot_pricing')->where('slot_id', $slot)->where('vehicle_model_id', $vehicle)->first();
            return response()->json($slotPrice);
        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
