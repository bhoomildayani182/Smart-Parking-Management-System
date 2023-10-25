<?php

namespace App\Http\Controllers;

use App\Models\DriverAndCleaner;
use Illuminate\Http\Request;

class DriverAndCleanerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $driverAndCleaner = DriverAndCleaner::select('id' ,'name','mobile','email_ID','designation')->paginate(10);
        
        return view('parking_space.driver_and_cleaner.index', [
            'driver_and_cleaner' => $driverAndCleaner
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverAndCleaner $driver_and_cleaner)
    {
        return response()->json($driver_and_cleaner);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverAndCleaner $driverAndCleaner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverAndCleaner $driverAndCleaner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverAndCleaner $driverAndCleaner)
    {
        //
    }
}
