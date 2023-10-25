<?php

namespace App\Http\Controllers\ParkingSpace;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlotPricingRequest;
use App\Models\SlotPricing;
use App\Models\Slot;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlotPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {

            $slot_pricing = SlotPricing::with('vehicle_model')->with('slot')->groupBy('vehicle_model_id','slot_id')->paginate(10);

            return view('parking_space.slot_pricing.index', [
                'slot_pricings' => $slot_pricing
            ]);


        } catch (Exception $e) {
            return back()->with('error',"something went wrong");
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $slots = Slot::select(DB::raw("CONCAT(start_time, ' - ', end_time, ' - ', duration) as slot_time"), 'id')->pluck('slot_time', 'id');
            $vehicle_models = VehicleModel::select(DB::raw("CONCAT(maker_name, '-' ,company_name) as vehicle_model"), 'id')->pluck('vehicle_model', 'id');

            return view('parking_space.slot_pricing.create',[
                'slot' => $slots,
                'vehicle_model' => $vehicle_models,
            ]);

        } catch (Exception $e) {
            return back()->with('error',"something went wrong");
        }
    }

    public function store(Request $request)
    {

        try {

            DB::beginTransaction();

            foreach($request->day as  $value)
            {


                $cleaner = DB::table('slot_pricing')->insertGetId([
                    'slot_id' => $request->slot_id,
                    'vehicle_model_id' => $request->vehicle_model_id,
                    'price' => $request->price[$value],
                    'day' => $value,
                    'created_by' => $request->user()->id,
                    'created_at' => Carbon::now()
                ]);
                $cleaners[] = $cleaner;
            }

            DB::commit();

            return redirect()->route('slots-pricing.index')->with('message', 'City added successfully');

        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('error',"something went wrong");
        }
    }


}
