<?php

namespace App\Http\Controllers\ParkingSpace;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\State;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cities = City::with('state')->paginate(10);
            return view('parking_space.city.index', [
                'cities' => $cities
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
            $state = State::pluck('name', 'id')->toArray();
            return view('parking_space.city.create',[
                'state' => $state,
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        try {
            City::create([
                'name' => $request->name,
                'state_id' => $request->state_id,
                'status' => $request->status,
                'created_by' => $request->user()->id,
            ]);

            toastr()->success('City added successfully!');
            return redirect()->route('city.list')->with('message', 'City added successfully');

        } catch (Exception $e) {
            dd($e);
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        try {
            $state = State::pluck('name', 'id')->toArray();
            return view('parking_space.city.update',[
                'city'=> $city,
                'state'=>$state
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        try {
            $city->update([
                'name' => $request->name,
                'state_id' => $request->state_id,
                'status' => $request->status,
                'updated_by'=> $request->user()->id
            ]);

            toastr()->success('City Updated successfully!');
            return redirect()->route('city.list')->with('message', 'City Updated successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city, Request $request)
    {
        try {
            $city->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);

            toastr()->success('City Deleted successfully!');
            return redirect()->route('city.list')->with('message', 'City Deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
