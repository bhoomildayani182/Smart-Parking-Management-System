<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleModelRequest;
use App\Models\City;
use App\Models\VehicleModel;
use App\Models\State;
use Exception;
use Faker\Core\Number;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VehicleModelRequest $request)
    {
        try {
            $vehicleModel = VehicleModel::paginate(10);

            return view('parking_space.vehicle_model.index', [
                'vehicleModel' => $vehicleModel
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

            return view('parking_space.vehicle_model.create',[

            ]);

        } catch (Exception $e) {

            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleModelRequest $request)
    {
        try {

            VehicleModel::create([

                "maker_name" => $request->maker_name,
                "model_number" => $request->model_number,
                "company_name" => $request->company_name,
                "type" => $request->type,
                "year" => $request->year,
                "description" => $request->description,
                "status" => ($request->status == "1") ? true : false,

            ]);
            toastr()->success('vehicle Model Added successfully');
            return redirect()->route('vehicle-models.index')->with('message', 'Vehicle Model added successfully');

        } catch (Exception $e) {

            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleModel $vehicleModel)
    {
        try {
            return view('parking_space.vehicle_model.update',[
                'vehicleModel'=> $vehicleModel,
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleModelRequest $request, VehicleModel $VehicleModel)
    {
        try {

            $VehicleModel->update([
                "maker_name" => $request->maker_name,
                "model_number" => $request->model_number,
                "company_name" => $request->company_name,
                "type" => $request->type,
                "year" => $request->year,
                "description" => $request->description,
                "status" => ($request->status == "1") ? true : false,
            ]);

            toastr()->success('vehicle Model Updated successfully');
            return redirect()->route('vehicle-models.index')->with('message', 'Vehicle Model Updated successfully');

        } catch (Exception $e) {

            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleModel $vehicleModel)
    {
        try {
            $vehicleModel->delete();
            toastr()->success('vehicle Model Deleted successfully');
            return redirect()->route('vehicle-models.index')->with('message', 'Vehicle Model Deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
