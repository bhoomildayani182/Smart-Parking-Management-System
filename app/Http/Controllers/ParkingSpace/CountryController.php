<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $countries = Country::paginate(10);
            return view('parking_space.country.index', [
                'countries' => $countries
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
            return view('parking_space.country.create');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        try {
            Country::create([
                'name' => $request->name,
                'status' => $request->status,
                'created_at' => Carbon::now(),
                'created_by' => $request->user()->id
            ]);
            toastr()->success('Country Created successfully!');
            return redirect()->route('country.list')->with('message', 'Country added successfully');

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
    public function edit(Country $country)
    {
        try {
            return view('parking_space.country.update',[
                'country'=> $country
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        try {
            $country->update([
            'name' => $request->name,
            'status' => $request->status,
            'updated_by' => $request->user()->id
        ]);
        toastr()->success('Country Updated successfully!');
        return redirect()->route('country.list')->with('message', 'Country Updated successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country, Request $request)
    {
        try {
            $country->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);

            toastr()->success('Country Deleted successfully!');

            return redirect()->route('country.list')->with('message', 'Country Deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
