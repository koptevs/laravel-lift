<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Lift;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $inspections = Inspection::with('lift')->get();
//        dd($inspections);
        return view('inspections.index', ['inspections' => $inspections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allLifts = Lift::with('liftManager')->get();
        $inspectionTypes = [
            'Pirmreizējā',
            'Kārtējā',
            'Ārpuskārtas',
            'Atkārtotā'
        ];
//        dd($lifts);
        return view('inspections.create', ['inspectionTypes' => $inspectionTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lift = Lift::with('liftManager')->where('reg_number', '=', '4CL846939')->first();
        $liftsLike = Lift::where('reg_number', 'like', '%'.'846'.'%')->get();
        dd($liftsLike);
        Inspection::create([

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
//        dd($inspection);
        return view('inspections.show', ['inspection' => $inspection, 'lift' => $inspection->lift]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
