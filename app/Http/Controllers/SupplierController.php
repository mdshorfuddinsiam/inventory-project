<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = cache()->rememberForever('suppliers', function(){
            return Supplier::latest()->get();
        });
        return view('backend.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.supplier.create');
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
            'mobile_no' => 'required|unique:suppliers',
            'email' => 'required|unique:suppliers',
            'address' => 'required',
        ],[
            'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;

        Supplier::create($data);
        $notification = [
            'message'       => 'Supplier inserted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('suppliers.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('backend.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'mobile_no' => 'required',
            'email' => 'required',
            'address' => 'required',
        ],[
            'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;

        $supplier->update($data);
        $notification = [
            'message'       => 'Supplier updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('suppliers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }

    public function delete(Supplier $supplier){
        $supplier->delete();
        $notification = [
            'message'       => 'Supplier deleted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('suppliers.index')->with($notification);
    }

    public function active(Supplier $supplier)
    {
        $supplier->update([
            'status' => '1',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Supplier status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('suppliers.index')->with($notification);
    }

    public function inactive(Supplier $supplier)
    {
        $supplier->update([
            'status' => '0',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Supplier status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('suppliers.index')->with($notification);
    }


}
