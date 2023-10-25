<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Http\Requests\ParkingRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $parkings = Parking::whereNull('deleted_at')->paginate(10);
            return view('parking_space.parking.index', [
                'parkings' => $parkings
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
        try {

            $country = Country::where('name', 'India')->first();
            $states = State::where('country_id', $country->id)->pluck('name', 'id')->toArray();
            $cities = City::select('state_id','name', 'id')->get()->toArray();
            $documentType = ["Adharcard" => "Aadhar Card", "DrivingLicense" => "Driving License"];

            return view('parking_space.parking.create',[
                'states' => $states,
                'cities' => $cities,
                'document_type' => $documentType
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParkingRequest $request)
    {
        try {

            $fileLocation = "ParkingDocuments/" . time() . "-" . $request->document->GetClientOriginalName();
            Storage::disk('public')->put($fileLocation, file_get_contents($request->document));

            $state = State::select('name')->where('id', $request->state_id)->first();
            $city = City::select('name')->where('id', $request->city_id)->first();
            Parking::create([
                'parking_name' => $request->parking_name,
                'address' => $request->address,
                'country' => "India",
                'state' => $state->name,
                'city' => $city->name,
                'pincode' => $request->pincode,
                'manager_name' => $request->manager_name,
                'manager_mobile_number' => $request->manager_mobile_number,
                'manager_email' => $request->manager_email,
                'document_file_id' => $fileLocation,
                'document_number' => $request->document_number,
                'document_type' => $request->document_type,
                'status' => $request->status,
                'created_by' => $request->user()->id
            ]);

            toastr()->success('Parking added successfully');

            return redirect()->route('parking.list')->with('message', 'Parking added successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Parking $parking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parking $parking)
    {
        try {

            $country = Country::where('name', $parking->country)->first();
            $states = State::where('country_id', $country->id)->pluck('name', 'id')->toArray();
            $cities = City::select('state_id','name', 'id')->get()->toArray();
            $documentType = ["Adharcard" => "Aadhar Card", "DrivingLicense" => "Driving License"];
            return view('parking_space.parking.update',[
                'parking' => $parking,
                'states' => $states,
                'cities' => $cities,
                'document_type' => $documentType
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParkingRequest $request, Parking $parking)
    {
        try{

            $fileLocation = $parking->document_file_id;
            if ($request->hasFile('document')) {
                unlink('storage/'. $parking->document_file_id);
                $fileLocation = "ParkingDocuments/" . time() . "-" . $request->document->GetClientOriginalName();
                Storage::disk('public')->put($fileLocation, file_get_contents($request->document));
            }

            $state = State::select('name')->where('id', $request->state_id)->first();
            $city = City::select('name')->where('id', $request->city_id)->first();
            $parking->update([
                'parking_name' => $request->parking_name,
                'address' => $request->address,
                'state' => $state->name,
                'city' => $city->name,
                'pincode' => $request->pincode,
                'manager_name' => $request->manager_name,
                'manager_mobile_number' => $request->manager_mobile_number,
                'manager_email' => $request->manager_email,
                'document_file_id' => $fileLocation,
                'status' => $request->status,
                'updated_by' => $request->user()->id
            ]);
            toastr()->success('Parking Updated successfully');
            return redirect()->route('parking.list')->with('message', 'Parking added successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parking $parking, Request $request)
    {
        try {

            $parking->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);

            toastr()->success('Parking Deleted successfully');
            return redirect()->route('parking.list')->with('message', 'Parking Deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
