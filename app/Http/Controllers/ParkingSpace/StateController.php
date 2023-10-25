<?php

namespace App\Http\Controllers\ParkingSpace;
use App\Http\Controllers\Controller;
use App\Http\Requests\StateRequest;
use App\Models\Country;
use App\Models\State;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $states = State::with('country')->paginate(10);
            return view('parking_space.state.index', [
                'states' => $states
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
            $country = Country::pluck('name', 'id')->toArray();
            return view('parking_space.state.create',[
                'country' => $country,
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        try {
            State::create([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'status' => $request->status,
                'created_by' => $request->user()->id,
            ]);

            toastr()->success('State Added successfully');
            return redirect()->route('state.list')->with('message', 'state added successfully');

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
    public function edit(State $state)
    {
        try {
            $country = Country::pluck('name', 'id')->toArray();
            return view('parking_space.state.update',[
                'state'=> $state,
                'country'=>$country
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, State $state)
    {
        try {
            $state->update([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'status' => $request->status,
                'updated_by' => $request->user()->id
            ]);
            toastr()->success('State Updated successfully');
            return redirect()->route('state.list')->with('message', 'state Updated successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state, Request $request)
    {
        try {
            $state->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);
            toastr()->success('State Deleted successfully');
            return redirect()->route('state.list')->with('message', 'State Deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
