<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Constants\IBDConstants;
use App\Http\Controllers\Controller;
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

class ExitBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bookings = EntryBooking::with('vehicle:vehicle_number,id', 'slot:start_time,end_time,duration,id')->where('status', IBDConstants::BookingStatus['EXIT'])->paginate(10);
            return view('parking_space.exit_booking.index', [
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
            $extra_time = ["1" => "1 hr", "2" => "2 hr", "3" => "3 hr", "4" => "4 hr", "5" => "5 hr","6" => "6 hr", "7" => "7 hr", "8" => "8 hr", "9" => "9 hr", "10" => "10 hr", "11" => "11 hr", "12" => "12 hr"];
            return view('parking_space.exit_booking.create', [
                'extra_time' => $extra_time
            ]);
        } catch (Exception $e){
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $vehicle = Vehicle::where('vehicle_number', $request->vehicle_number)->first();

            if(is_null($vehicle)) {
                return redirect()->route('exit-booking.create')->with('message', 'No vehicle found');
            }

            $entryBooking = EntryBooking::where('vehicle_id', $vehicle->id)->whereNull('exit_time')->first();

            if(is_null($entryBooking)) {
                return redirect()->route('exit-booking.create')->with('message', 'No booking found for this vehicle');
            }

            $entryBooking->update([
                'exit_time' => Carbon::now(),
                'extra_amount' => $request->extra_amount,
                'total_amount' => $entryBooking->price + $request->extra_amount,
                'status' => IBDConstants::BookingStatus["EXIT"],
                'updated_by' => $request->user()->id
            ]);

            ParkingSlotDetails::where('id', $entryBooking->parking_space_id)->update([
                'is_booked' => false
            ]);

            DB::commit();
            toastr()->success('The vehicle exit process has been successfully completed');
            return redirect()->route('exit-booking.index')->with('message', 'The vehicle exit process has been successfully completed');

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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntryBooking $entry_booking)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntryBooking $entry_booking, Request $request)
    {

    }

    public function get_booking($vehicle_number){
        try{

            $vehicle = Vehicle::where('vehicle_number', $vehicle_number)->first();

            if(is_null($vehicle)) {
                return response()->json(["status" => 401,"data" => [] , "message" => "Vehicle Not Found"]);
            }

            $entry_booking = EntryBooking::with('vehicle:vehicle_number,id,cleaner_id','driver:id,name,mobile,address,state,city','slot:id,start_time,end_time,duration','vehicleModel:id,company_name,maker_name')
            ->where('vehicle_id', $vehicle->id)
            ->whereNull('exit_time')
            ->first();

            if(is_null($entry_booking)) {
                return response()->json(["status" => 401,"data" => [] , "message" => "No Booking Found For This Vehicle"]);
            }

            $cleaners = DriverAndCleaner::select('name', 'mobile', 'address', 'state', 'city')->whereIn('id', json_decode($entry_booking->vehicle->cleaner_id))->get();

            return response()->json(["status" => 200, "data" => [
                "vehicle" => $vehicle,
                "entry_booking" => $entry_booking,
                "cleaners" => $cleaners
            ], "message" => "Data fetched successfully"]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    public function get_number_plates($vehicle_number){
        try{
            $numberPlates = DB::table('vehicle as v')
                ->join('booking as b', 'v.id', 'b.vehicle_id')
                ->where('b.status', '!=', 'exit')
                ->where('v.vehicle_number', 'like', '%' . $vehicle_number . '%')
                ->pluck('v.vehicle_number');

            if(!count($numberPlates)) {
                return response()->json(["status" => 401,"data" => [] , "message" => "Number Plate Not Found"]);    
            }

            return response()->json(["status" => 200, "data" => [
                'number_plates' => $numberPlates
            ], "message" => "Number Plate fetched successfully"]);

        } catch (Exception $e) {
            return back()->with('error',"something went wrong");
        }
    }
}
