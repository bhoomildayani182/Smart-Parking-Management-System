<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Parking;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::paginate(10);
            return view('parking_space.user.index',[
                'users' => $users
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
            $roles = [1 => 'ADMIN', 2 => 'MANAGER'];
            $states = State::pluck('name', 'id')->where('country_id',101)->toArray();
            $cities = City::select('state_id','name', 'id')->where('country_id',101)->get()->toArray();
            $parking = Parking::pluck('parking_name', 'id')->toArray();
            return view('parking_space.user.create', [
                'roles' => $roles,
                'states' => $states,
                'cities' => $cities,
                'parking' => $parking
            ]);

        } catch (Exception $e) {
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
            $state = State::select('name')->where('id', $request->state_id)->first();
            $city = City::select('name')->where('id', $request->city_id)->first();

            User::create([
                'name' => $request->name,
                'mobile_number' => $request->mobile_number,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $city->name,
                'state' => $state->name,
                'country' => "India",
                'pincode' => $request->pincode,
                'role_id' => $request->role_id,
                'default_parking_id' => $request->default_parking_id,
                'is_active' => $request->is_active,
                'created_by' => $request->user()->id,
            ]);
            toastr()->success('User Added successfully');
            return redirect()->route('user.index')->with('message', 'User added successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try {
            $roles = [1 => 'ADMIN', 2 => 'MANAGER'];
            $states = State::pluck('name', 'id')->where('country_id',101)->toArray();
            $cities = City::select('state_id','name', 'id')->where('country_id',101)->get()->toArray();
            $parking = Parking::pluck('parking_name', 'id')->toArray();
            return view('parking_space.user.update', [
                'roles' => $roles,
                'states' => $states,
                'cities' => $cities,
                'parking' => $parking,
                'user' => $user
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $state = State::select('name')->where('id', $request->state_id)->first();
            $city = City::select('name')->where('id', $request->city_id)->first();

            $user->update([
                'name' => $request->name,
                'mobile_number' => $request->mobile_number,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $city->name,
                'state' => $state->name,
                'country' => "India",
                'pincode' => $request->pincode,
                'role_id' => $request->role_id,
                'default_parking_id' => $request->default_parking_id,
                'is_active' => $request->is_active,
                'updated_by' => $request->user()->id,
            ]);
            toastr()->success('User Updated successfully');
            return redirect()->route('user.index')->with('message', 'User updated successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Request $request)
    {
        try {
            $user->update([
                'deleted_at' => Carbon::now(),
                'deleted_by' => $request->user()->id
            ]);
            toastr()->success('User Deleted successfully');
            return redirect()->route('user.index')->with('message', 'User updated successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
