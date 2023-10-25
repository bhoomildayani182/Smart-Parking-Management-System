<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlotRequest;
use App\Models\City;
use App\Models\Slot;
use App\Models\State;
use Carbon\Carbon;
use Exception;
use Faker\Core\Number;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SlotRequest $request)
    {
        try {
            $slot = Slot::paginate(10);

            return view('parking_space.slot.index', [
                'slot' => $slot
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

            return view('parking_space.slot.create',[]);

        } catch (Exception $e) {

            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlotRequest $request)
    {
        try {

            $start = Carbon::createFromFormat('H:i:s', (!isset(explode(":",$request->start_time)[2]) ? $request->start_time . ":00" : $request->start_time));
            $end = Carbon::createFromFormat('H:i:s',!isset(explode(":",$request->end_time)[2]) ? $request->end_time . ":00" : $request->end_time);

            // Check if the end time is earlier than the start time
            if ($end->lt($start)) {
                $end->addDay(); // Add a day to the end time
            }

            $duration = ($end->diff($start))->format('%H:%I:%S');

            Slot::create([

                "start_time" => $request->start_time,
                "end_time" => $request->end_time,
                "duration" => $duration,
                "status" => ($request->status == "1") ? true : false,
                "parking_id" => isset(auth()->user()->parking_id) ? auth()->user()->parking_id : config('parking_space.default_parking_id'),

            ]);

            toastr()->success('Slot Added successfully');
            return redirect()->route('slot.index')->with('message', 'Slot added successfully');

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
    public function edit(Slot $slot)
    {
        try {
            return view('parking_space.slot.update',[
                'slot'=> $slot,
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlotRequest $request, Slot $Slot)
    {
        try {

            $start = Carbon::createFromFormat('H:i:s', (!isset(explode(":",$request->start_time)[2]) ? $request->start_time . ":00" : $request->start_time));
            $end = Carbon::createFromFormat('H:i:s',!isset(explode(":",$request->end_time)[2]) ? $request->end_time . ":00" : $request->end_time);

            // Check if the end time is earlier than the start time
            if ($end->lt($start)) {
                $end->addDay(); // Add a day to the end time
            }

            $duration = ($end->diff($start))->format('%H:%I:%S');

            $Slot->update([
                "start_time" => $request->start_time,
                "end_time" => $request->end_time,
                "duration" => $duration,
                "status" => ($request->status == "1") ? true : false,
                "parking_id" => isset(auth()->user()->parking_id) ? auth()->user()->parking_id : config('parking_space.default_parking_id'),
            ]);
            toastr()->success('Slot updated successfully');
            return redirect()->route('slot.index')->with('message', 'Slot Updated successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slot $slot)
    {
        try {
            $slot->delete();
            toastr()->success('Slot Deleted successfully');
            return redirect()->route('state.list')->with('message', 'Slot Deleted successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }
}
