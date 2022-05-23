<?php

namespace App\Http\Controllers;

use App\Models\Lift;
use App\Models\LiftManager;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $lifts = Lift::with('liftManager')->get();

        return view('lifts.index', ['lifts' => $lifts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():View
    {
//        app()->setLocale('lv');
        // create form
        $liftManagers = LiftManager::all();

        return view('lifts.create', ['liftManagers' => $liftManagers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequestData = $request->validate([
//            'reg_number' => ['bail', 'required', 'unique:lifts'],
            'reg_number' => ['required', 'unique:lifts'],
            'lift_manager_id' => ['required'],
            'lift_type' => ['required'],
            'manufacture_year' => ['required'],
        ]);
//        dd($validatedRequestData);
        // submit action for the create form
        Lift::create([
            'reg_number' => $validatedRequestData['reg_number'],
            'lift_manager_id' => $validatedRequestData['lift_manager_id'],
            'lift_type' => $validatedRequestData['lift_type'],
            'manufacture_year' => $validatedRequestData['manufacture_year'],
            'manufacturer_name' => $request->input('manufacturer_name'),
            'city' => $request->input('city'),
            'street' => $request->input('street'),
            'house' => $request->input('house'),
            'entrance' => $request->input('entrance'),
        ]);

        return redirect()->route('lifts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lift  $lift
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Lift $lift)
    {
        // single Lift page
        return view('lifts.show', ['lift' => $lift]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lift  $lift
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Lift $lift)
    {
        // edit form
        $liftManagers = LiftManager::all();

        return view('lifts.edit', ['lift' => $lift, 'liftManagers' => $liftManagers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lift  $lift
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lift $lift)
    {
        // action for edit form
        $lift->update([
            'reg_number' => $request->input('reg_number'),
            'lift_manager_id' => $request->input('lift_manager_id'),
            'lift_type' => $request->input('lift_type'),
            'manufacturer_name' => $request->input('manufacturer_name'),
            'manufacture_year' => $request->input('manufacture_year'),


        ]);

        return redirect()->route('lifts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lift  $lift
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lift $lift)
    {
        // delete Lift
        $lift->delete();

        return redirect()->route('lifts.index');

    }
}
