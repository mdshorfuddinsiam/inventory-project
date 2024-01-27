<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    
	public function stockReport(){
		$products = Product::with('supplier', 'unit', 'category')->orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
		return view('backend.stock.stock_report', compact('products'));
	}

	public function stockReportPdf(){
		$products = Product::with('supplier', 'unit', 'category')->orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
		return view('backend.pdf.stock_report_pdf', compact('products'));
	}

	public function stockSupplierProductWise(){
		$suppliers = Supplier::latest()->get();
		$categories = Category::latest()->get();
		return view('backend.stock.stock_supplier_product_wise', compact('suppliers', 'categories'));
	}

	public function stockSupplierWisePdf(Request $request){
		$products = Product::with('supplier', 'unit', 'category')->where('supplier_id', $request->supplier_id)->orderBy('supplier_id', 'asc')->orderBy('category_id', 'asc')->get();
		return view('backend.pdf.stock_supplier_wise_pdf', compact('products'));
	}

	public function stockProductWisePdf(Request $request){
		$product = Product::with('supplier', 'unit', 'category')->where('category_id', $request->category_id)->where('id', $request->product_id)->first();
		return view('backend.pdf.stock_product_wise_pdf', compact('product'));
	}


}
