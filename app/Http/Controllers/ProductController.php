<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = cache()->rememberForever('products', function(){
            return Product::with('supplier', 'unit', 'category')->latest()->get();
        });
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.create', compact('suppliers', 'units', 'categories'));
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
            'supplier_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'category_id' => 'required|integer',
            'name' => 'required|max:255',
        ],[
            // 'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;

        Product::create($data);
        $notification = [
            'message'       => 'Product inserted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $suppliers = Supplier::latest()->get();
        $units = Unit::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.edit', compact('product', 'suppliers', 'units', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $validated = $request->validate([
            'supplier_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'category_id' => 'required|integer',
            'name' => 'required|max:255',
        ],[
            // 'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;

        $product->update($data);
        $notification = [
            'message'       => 'Product updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function delete(Product $product){
        $product->delete();
        $notification = [
            'message'       => 'Product deleted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('products.index')->with($notification);
    }

    public function active(Product $product)
    {
        $product->update([
            'status' => '1',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Product status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('products.index')->with($notification);
    }

    public function inactive(Product $product)
    {
        $product->update([
            'status' => '0',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Product status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('products.index')->with($notification);
    }


}
