<?php

namespace App\Http\Controllers;

use App\Models\DriverAndCleaner;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    function get_vehicle($vehicle_number) {
        try{    
            $vehicle = Vehicle::with('driver')->where('vehicle_number',$vehicle_number)->first();

            if(is_null($vehicle)) {
                return response()->json(["status" => 400, "data" => [], "message" => "No Vehicle Found"]); 
            }

            $cleaners = DriverAndCleaner::whereIn('id', json_decode($vehicle->cleaner_id))->get();

            return response()->json(["status" => 200, "data" => [
                "vehicle" => $vehicle,
                "cleaners" => $cleaners
            ], "message" => "Data fetched successfully"]);

        } catch(Exception $e){
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
