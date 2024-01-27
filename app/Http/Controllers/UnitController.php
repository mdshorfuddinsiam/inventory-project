<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = cache()->rememberForever('units', function(){
            return Unit::latest()->get();
        });
        return view('backend.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|max:255',
        ],[
            // 'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;

        Unit::create($data);
        $notification = [
            'message'       => 'Unit inserted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('units.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('backend.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ],[
            // 'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;

        $unit->update($data);
        $notification = [
            'message'       => 'Unit updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('units.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }

    public function delete(Unit $unit){
        $unit->delete();
        $notification = [
            'message'       => 'Unit deleted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('units.index')->with($notification);
    }

    public function active(Unit $unit)
    {
        $unit->update([
            'status' => '1',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Unit status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('units.index')->with($notification);
    }

    public function inactive(Unit $unit)
    {
        $unit->update([
            'status' => '0',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Unit status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('units.index')->with($notification);
    }


}
