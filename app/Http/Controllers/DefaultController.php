<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DefaultController extends Controller
{

	// For Purchase
	public function getCategory(Request $request){
		// dd($request);
		$categories = Product::with('category')->select('category_id')->where('supplier_id', $request->supplier_id)->groupBy('category_id')->get();
		// dd($categories);
		return response()->json($categories);
	}

	// For Purchase
	public function getCatwiseProduct(Request $request){
		// dd($request);
		// $products = Product::where('category_id', $request->category_id)->get();
		$products = Product::where('category_id', $request->category_id)->where('supplier_id', $request->supplier_id)->get();
		// dd($products);
		return response()->json($products);
	}

	// For Invoice
	public function getProduct(Request $request){
		// dd($request);
		$products = Product::where('category_id', $request->category_id)->get();
		// dd($products);
		return response()->json($products);
	}

	// For Invoice
	public function getProductStock(Request $request){
		// dd($request);
		$product_stock = Product::where('id', $request->product_id)->first()->quantity;
		// dd($product_stock);
		return response()->json($product_stock);
	}

    
}
