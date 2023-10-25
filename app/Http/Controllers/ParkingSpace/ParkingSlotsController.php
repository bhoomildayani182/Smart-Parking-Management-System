<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingSlotsRequest;
use App\Models\Parking;
use App\Models\ParkingSlotDetails;
use App\Models\ParkingSlots;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParkingSlotsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $parkingSlots = ParkingSlots::paginate(10);
            return view('parking_space.parking_slots.index', [
                'parkingSlots' => $parkingSlots
            ]);

        } catch (Exception $e) {
            return back()->with('error', 'something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $zone = ['North' => 'North', 'East' => 'East', 'South' => 'South', 'West' => 'West'];
            $section = ["A" => "A", "B" => "B", "C" => "C", "D" => "D", "E" => "E", "F" => "F", "G" => "G", "H" => "H"];
            $parkings = Parking::pluck('parking_name', 'id')->toArray();
            return view('parking_space.parking_slots.create',[
                'zone' => $zone,
                'section' => $section,
                'parkings' => $parkings
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParkingSlotsRequest $request)
    {
        try {
            $parkingSlot = ParkingSlots::create([
                'zone' => $request->zone,
                'section' => $request->section,
                'parking_slot' => $request->parking_slot,
                'name' => $request->name,
                'parking_id' => $request->parking_id,
                'created_by' => $request->user()->id
            ]);

            $parkingSlotsDetails = [];
            for ($i=1; $i <= $request->parking_slot; $i++) {
                $parkingSlotsDetail = [
                    'space_name' => $request->zone . '-' . $request->section . '-' . $i,
                    'slot_id' => $parkingSlot->id,
                    'is_booked' => false,
                    'created_by' => $request->user()->id
                ];
                $parkingSlotsDetails[] = $parkingSlotsDetail;
            }
            ParkingSlotDetails::insert($parkingSlotsDetails);

            toastr()->success('Parking Slot Added successfully');
            return redirect()->route('parking_slots.list')->with('message', 'Parking Slots added successfully');

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkingSlots $parkingSlots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingSlots $parkingslot)
    {
        try {
            $zone = ['North' => 'North', 'East' => 'East', 'South' => 'South', 'West' => 'West'];
            $section = ["A" => "A", "B" => "B", "C" => "C", "D" => "D", "E" => "E", "F" => "F", "G" => "G", "H" => "H"];
            $parkings = Parking::pluck('parking_name', 'id')->toArray();
            return view('parking_space.parking_slots.update',[
                'parking_slot' => $parkingslot,
                'zone' => $zone,
                'section' => $section,
                'parkings' => $parkings
            ]);

        } catch (Exception $e) {
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParkingSlotsRequest $request, ParkingSlots $parkingslot)
    {
        try {

            DB::beginTransaction();

            $booked_slot = ParkingSlotDetails::where('slot_id', $parkingslot->id)->where('is_booked', true)->count();
            if($booked_slot > 0){
                return back()->with('error', 'first free all slots');
            }

            ParkingSlotDetails::where('slot_id', $parkingslot->id)->delete();

            $parkingSlotsDetails = [];
            for ($i=1; $i <= $request->parking_slot; $i++) {
                $parkingSlotsDetail = [
                    'space_name' => $request->zone . '-' . $request->section . '-' . $i,
                    'slot_id' => $parkingslot->id,
                    'is_booked' => false,
                    'created_by' => $request->user()->id
                ];
                $parkingSlotsDetails[] = $parkingSlotsDetail;
            }
            ParkingSlotDetails::insert($parkingSlotsDetails);

            $parkingslot->update([
                'zone' => $request->zone,
                'section' => $request->section,
                'parking_slot' => $request->parking_slot,
                'parking_id' => $request->parking_id,
                'name' => $request->name,
                'updated_by' => $request->user()->id,
            ]);

            DB::commit();
            toastr()->success('Parking Updated Added successfully');
            return redirect()->route('parking_slots.list')->with('message', 'City Updated successfully');

        } catch (Exception $e) {
            DB::rollBack();
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingSlots $parkingslot, Request $request)
    {
        try {

            DB::beginTransaction();

            $booked_slot = ParkingSlotDetails::where('slot_id', $parkingslot->id)->where('is_booked', true)->count();
            if($booked_slot > 0){
                return back()->with('error', 'first free all slots');
            }

            ParkingSlotDetails::where('slot_id', $parkingslot->id)->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);

            $parkingslot->update([
                'deleted_by' => $request->user()->id,
                'deleted_at' => Carbon::now()
            ]);

            DB::commit();
            toastr()->success('Parking Slot Deleted successfully');
            return redirect()->route('parking_slots.list')->with('message', 'Parking Deleted successfully');

        } catch (Exception $e) {
            DB::rollBack();
            toastr()->error('Oops! Something went wrong!');
            return back()->with('error',"something went wrong");
        }
    }

    public function getParkingSlotDetails($parkingslot)
    {
        $parkingSlotDetails = ParkingSlotDetails::with('slot')->where('slot_id', $parkingslot)->get();
        return view('parking_space.parking_slot_details.index', [
            'parkingslotdetails' => $parkingSlotDetails
        ]);
    }
}
