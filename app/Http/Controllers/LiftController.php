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
    public function create(): View
    {
//        app()->setLocale('lv');
        // create form
        $liftManagers = LiftManager::all();

        return view('lifts.create', [
            'liftManagers' => $liftManagers,
            'liftTypes' => ['elektriskais', 'hidrauliskais'],
            'cityRegions' => ['Centra rajons', 'Latgales priekšpilsēta', 'Vidzemes priekšpilsēta', 'Ziemeļu priekšpilsēta',
                'Zemgales priekšpilsēta', 'Kurzemes rajons'],
        ]);
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
            'country' => ['required'],
            'city' => ['required'],
            'street' => ['required'],
            'postal_code' => ['required'],
            'house' => ['required'],
            'load_capacity' => ['required', 'numeric'],
            'speed' => ['numeric'],

        ]);
//        dd($validatedRequestData);
        // submit action for the create form
        Lift::create([
            'reg_number' => $validatedRequestData['reg_number'],
            'lift_manager_id' => $validatedRequestData['lift_manager_id'],
            'lift_type' => $validatedRequestData['lift_type'],
            'manufacture_year' => $validatedRequestData['manufacture_year'],
            'country' => $validatedRequestData['country'],
            'city' => $validatedRequestData['city'],
            'street' => $validatedRequestData['street'],
            'house' => $validatedRequestData['house'],
            'postal_code' => $validatedRequestData['postal_code'],
            'load_capacity' => $validatedRequestData['load_capacity'],
            'speed' => $validatedRequestData['speed'],

            'manufacturer_name' => $request->input('manufacturer_name'),
            'factory_number' => $request->input('factory_number'),
            'installer' => $request->input('installer'),

            'city_region' => $request->input('city_region'),
            'entrance' => $request->input('entrance'),
            'floors_total' => $request->input('floors_total'),
            'floors_serviced' => $request->input('floors_serviced'),
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
