<?php

namespace App\Http\Controllers;

use App\Models\LiftManager;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LiftManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $lift_managers = LiftManager::all();

        return view('lift-managers.index', compact('lift_managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $lift_managers = LiftManager::all();

        return view('lift-managers.create', compact('lift_managers'));
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
//        $requestData  = $request->all();
//        $lift_manager = new LiftManager([
//            'name'       => $requestData['name'],
//            'reg_number' => $requestData['reg_number']
//        ]);
//        $lift_manager->save();

        // ik - functionally the same as above
        // https://laravel.com/docs/9.x/eloquent : However, before using the create method, you will need to specify
        // either a fillable or guarded property on your model class.

        LiftManager::create([
            'name'       => $request->input('name'),
            'address'    => $request->input('address'),
            'reg_number' => $request->input('reg_number')
        ]);

        return redirect()->route('lift-managers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(LiftManager $lift_manager): View
    {
        return view('lift-managers.show', compact('lift_manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(LiftManager $lift_manager): View
    {

//        return view('lift-managers.edit', compact('lift_manager'));
        return view('lift-managers.edit', compact('lift_manager'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LiftManager $lift_manager)
    {
        $lift_manager->update([
            'name'       => $request->input('name'),
            'address'    => $request->input('address'),
            'reg_number' => $request->input('reg_number'),
        ]);

        return redirect()->route('lift-managers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiftManager $lift_manager)
    {
        $lift_manager->delete();

        return redirect()->route('lift-managers.index');

    }
}
