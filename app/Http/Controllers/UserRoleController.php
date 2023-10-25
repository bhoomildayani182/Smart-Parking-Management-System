<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $items = Role::where('name','like',"%" .$request->name . "%")->paginate(1);
            return view('admin.roles.index1',compact('items'));
            // The request is an AJAX request
            // Perform AJAX-specific logic here
        }
        $items = Role::where('name','like',"%" .$request->name . "%")->paginate(3);
        return view('admin.roles.index',compact('items'));

    }
     public function index1(Request $request)
    {

        // dd($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Role::create(['name' => $request->name]);

        return redirect()->route('userRole.index');

        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
