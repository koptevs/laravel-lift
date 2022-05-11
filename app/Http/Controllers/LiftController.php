<?php

namespace App\Http\Controllers;

use App\Models\Lift;
use Illuminate\Http\Request;

class LiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lifts = Lift::with('lift_manager')->get();

        return view('lifts.index', compact('lifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create form
        return view('lifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // submit action for the form
        Lift::create([
            'reg_number' => $request->input('reg_number'),
            'lift_manager_id' => $request->input('lift_manager_id'),
            'lift_type' => $request->input('lift_type'),
            'manufacturer_name' => $request->input('manufacturer_name'),
            'manufacture_year' => $request->input('manufacture_year'),

        ]);

        return  redirect()->route('lifts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lift  $lift
     * @return \Illuminate\Http\Response
     */
    public function show(Lift $lift)
    {
        // single Lift page
        return view('lifts.show', compact('lift'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lift  $lift
     * @return \Illuminate\Http\Response
     */
    public function edit(Lift $lift)
    {
        // edit form
        return view('lifts.edit', compact('lift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lift  $lift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lift $lift)
    {
        // action for edit form
        $lift->update([
            'reg_number' => $request->input('reg_number'),
        ]);

        return  redirect()->route('lifts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lift  $lift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lift $lift)
    {
        // delete Lift
        $lift->delete();

        return  redirect()->route('lifts.index');

    }
}
