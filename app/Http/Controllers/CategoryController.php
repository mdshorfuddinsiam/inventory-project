<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = cache()->rememberForever('categories', function(){
            return Category::latest()->get();
        });
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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

        Category::create($data);
        $notification = [
            'message'       => 'Category inserted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
        ],[
            // 'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;

        $category->update($data);
        $notification = [
            'message'       => 'Category updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function delete(Category $category){
        $category->delete();
        $notification = [
            'message'       => 'Category deleted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('categories.index')->with($notification);
    }

    public function active(Category $category)
    {
        $category->update([
            'status' => '1',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Category status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('categories.index')->with($notification);
    }

    public function inactive(Category $category)
    {
        $category->update([
            'status' => '0',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Category status updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('categories.index')->with($notification);
    }


}
