<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Http\Requests\NumberPlateMasterRequest;
use App\Models\City;
use App\Models\NumberPlate;
use App\Models\State;
use Exception;
use Faker\Core\Number;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NumberPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NumberPlateMasterRequest $request)
    {
        try {
            $numberPlate = NumberPlate::paginate(10);

            return view('parking_space.number_plate_master.index', [
                'numberPlate' => $numberPlate
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
            $states = State::pluck('name', 'id')->where('country_id',101)->toArray();
            $cities = City::select('state_id','name', 'id')->where('country_id',101)->get()->toArray();

            return view('parking_space.number_plate_master.create',[
                'states' => $states,
                'cities' => $cities
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NumberPlateMasterRequest $request)
    {
        try {

            $city = City::find($request->city);
            $state = State::find($request->state);


            NumberPlate::create([
                'group_of_letter' => $request->group_of_letter,
                'state_id' => $request->state,
                'state_name' => $state->name,
                'city_id' => $request->city,
                'city_name' => $city->name,
                'city_number' => $request->city_number,
            ]);
            toastr()->success('Number Plate added successfully');
            return redirect()->route('number-plate.index')->with('message', 'Number Plate added successfully');

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
    public function edit(NumberPlate $numberPlate)
    {
        try {
            $states = State::pluck('name', 'id')->where('country_id',101)->toArray();
            $cities = City::select('state_id','name', 'id')->where('country_id',101)->get()->toArray();

            return view('parking_space.number_plate_master.update',[
                'numberPlate'=> $numberPlate,
                'states' => $states,
                'cities' => $cities
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NumberPlateMasterRequest $request, NumberPlate $NumberPlate)
    {
        try {

            $city = City::find($request->city);
            $state = State::find($request->state);

            $NumberPlate->update([
                'group_of_letter' => $request->group_of_letter,
                'state_id' => $request->state,
                'state_name' => $state->name,
                'city_id' => $request->city,
                'city_name' => $city->name,
                'city_number' => $request->city_number,
            ]);
            toastr()->success('Number Plate Updated successfully');
            return redirect()->route('number-plate.index')->with('message', 'Number Plate Updated successfully');

        } catch (Exception $e) {

            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NumberPlate $numberPlate)
    {
        try {
            $numberPlate->delete();
            toastr()->success('Number Plate Deleted successfully');
            return redirect()->route('number-plate.index')->with('message', 'Number Plate Deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
