<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    
	public function index(){
		$invoices = cache()->rememberForever('invoices', function(){
		    return Invoice::with('payment')->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
		});
		return view('backend.invoice.index', compact('invoices'));
	}

	public function create(){
		$invoice = Invoice::latest()->first();
		// dd($invoice);
		if($invoice == null){
			$invoice_no = '1';
		}else{
			$invoice_no = $invoice->invoice_no + '1';
		}
		$date = date('Y-m-d');
		$categories = Category::orderBy('name', 'asc')->get();
		$customers = Customer::orderBy('name', 'asc')->get();
		return view('backend.invoice.create', compact('categories', 'invoice_no', 'date', 'customers'));
	}

	public function store(Request $request){
		// dd($request->all());

		$validated = $request->validate([
		    'paid_status' => 'required',
		    'customer_id' => 'required',
		]); 
		if($request->paid_status == 'partial_paid'){
			$validated = $request->validate([
			    'paid_amount' => 'required',
			]); 
		}
		if($request->customer_id == '0'){
			$validated = $request->validate([
			    'name' => 'required',
			    'email' => 'required',
			    'mobile_no' => 'required',
			]); 
		}

		if($request->category_id == null){
			$notification = [
			    'message' => 'Sorry you do no select any item!!',
			    'alert-type' => 'error'
			];
			return redirect()->back()->with($notification);
		}
		else{
			if($request->paid_amount > $request->estimated_amount){
				$notification = [
				    'message' => 'Sorry Paid Amount is Maximum then the total price!!',
				    'alert-type' => 'error'
				];
				return redirect()->back()->with($notification);
			}
			else{
				$invoice = new Invoice();
				$invoice->date = date('Y-m-d', strtotime($request->date));
				$invoice->invoice_no = $request->invoice_no;
				$invoice->description = $request->description;
				$invoice->status = '0';
				$invoice->created_by = auth()->user()->id;
				DB::transaction(function() use ($invoice, $request){
				    if($invoice->save()){
				    	$count_category = count($request->category_id);
				    	for ($i=0; $i < $count_category ; $i++) { 
				    	 	$invoice_detail = new InvoiceDetail();
				    	 	$invoice_detail->invoice_id = $invoice->id;
				    	 	$invoice_detail->date = date('Y-m-d', strtotime($request->date));
				    	 	$invoice_detail->category_id = $request->category_id[$i];
				    	 	$invoice_detail->product_id = $request->product_id[$i];
				    	 	$invoice_detail->selling_qty = $request->selling_qty[$i];
				    	 	$invoice_detail->unit_price = $request->unit_price[$i];
				    	 	$invoice_detail->selling_price = $request->selling_price[$i];
				    	 	$invoice_detail->status = '0';
				    	 	$invoice_detail->save();
				    	} 
				    	if($request->customer_id == '0'){
				    		$customer = new Customer();
				    		$customer->name = $request->name;
				    		$customer->mobile_no = $request->mobile_no;
				    		$customer->email = $request->email;
				    		$customer->save();
				    		$customer_id = $customer->id;
				    	}else{
				    		$customer_id = $request->customer_id;
				    	}

				    	$payment = new Payment();
				    	$payment_detail = new PaymentDetail();

				    	$payment->invoice_id = $invoice->id;
				    	$payment->customer_id = $customer_id;
				    	$payment->paid_status = $request->paid_status;
				    	$payment->total_amount = $request->estimated_amount;
				    	$payment->discount_amount = $request->discount_amount;

				    	if($request->paid_status == 'partial_paid'){
				    		$payment->paid_amount = $request->paid_amount;
				    		$payment->due_amount = $request->estimated_amount - $request->paid_amount;
				    		$payment_detail->current_paid_amount = $request->paid_amount;
				    	}
				    	else if($request->paid_status == 'full_paid'){
				    		$payment->paid_amount = $request->estimated_amount;
				    		$payment->due_amount = '0';
				    		$payment_detail->current_paid_amount = $request->estimated_amount;
				    	}
				    	else if($request->paid_status == 'full_due'){
				    		$payment->paid_amount = '0';
				    		$payment->due_amount = $request->estimated_amount;
				    		$payment_detail->current_paid_amount = '0';
				    	}
				    	$payment->save();

				    	$payment_detail->invoice_id = $invoice->id;
				    	$payment_detail->date = date('Y-m-d', strtotime($request->date));
				    	$payment_detail->save();  
				    }
				});
			    $notification = array(
		            'message' => 'Invoice Data Inserted Successfully', 
		            'alert-type' => 'success'
		        );
		        return redirect()->route('invoices.pending.list')->with($notification);
			}
		}
		// ============= udemy notification akhane dise=============
	} // end method

	public function invoicePendingList(){
		$pendingList = Invoice::with('payment')->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
		return view('backend.invoice.invoice_pending_list', compact('pendingList'));
	}

	public function delete(Invoice $invoice){
		// dd($invoice);
		$invoice->delete();
		InvoiceDetail::where('invoice_id', $invoice->id)->delete();
		Payment::where('invoice_id', $invoice->id)->delete();
		PaymentDetail::where('invoice_id', $invoice->id)->delete();

	    $notification = array(
            'message' => 'Invoice Deleted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
	}

	public function invoiceApprove(Invoice $invoice){
		$payment = Payment::with('customer')->where('invoice_id', $invoice->id)->first();
		return view('backend.invoice.invoice_approve', compact('invoice', 'payment'));
	}

	public function invoiceApprovalStore(Request $request,Invoice $invoice){
		// dd($invoice);
		// dd($request->all());
		foreach($request->selling_qty as $key => $row){
			$invoiceDetail = InvoiceDetail::where('id', $key)->first();
			// dd($invoiceDetail);
			$product = Product::where('id', $invoiceDetail->product_id)->first();
			// dd($product);
			if($product->quantity < $invoiceDetail->selling_qty){
			    $notification = array(
		            'message' => 'Sorry you approve Maximum Value', 
		            'alert-type' => 'error'
		        );
		        return redirect()->back()->with($notification);
			}
		}

		$invoice->status = '1';
		$invoice->updated_by = auth()->user()->id;
		DB::transaction(function() use($request, $invoice){
			foreach($request->selling_qty as $key => $row){
				$invoiceDetail = InvoiceDetail::where('id', $key)->first();
				$invoiceDetail->status = '1';
				$invoiceDetail->save();

				$product = Product::where('id', $invoiceDetail->product_id)->first();
				$product->quantity = ((float)$product->quantity - (float)$invoiceDetail->selling_qty);
				$product->save();
			}
		});
		$invoice->save();
		$notification = array(
	        'message' => 'Invoice Approve Successfully', 
	        'alert-type' => 'success'
	    );
	    return redirect()->route('invoices.pending.list')->with($notification);
	}

	public function invoicePrintList(){
		$invoices = Invoice::with('invoice_details', 'payment')->orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '1')->get();
		return view('backend.invoice.invoice_print_list', compact('invoices'));
	}

	public function invoicePrint(Invoice $invoice){
		$invoice = Invoice::with('invoice_details', 'payment')->where('id', $invoice->id)->first();
		// dd($invoice);
		return view('backend.pdf.invoice_pdf', compact('invoice'));
	}

	public function invoiceDailyReport(){
		return view('backend.invoice.invoice_daily_report');
	}

	public function invoiceDailyPdf(Request $request){
		// dd($request->all());
		$validated = $request->validate([
		    'start_date' => 'required',
		    'end_date' => 'required',
		]); 

		$start_date = date('Y-m-d', strtotime($request->start_date));
		$end_date = date('Y-m-d', strtotime($request->end_date));
		// dd($end_date);
		$invoice_daily = Invoice::with('invoice_details')->whereBetween('date', [$start_date, $end_date])->whereStatus('1')->get();
		return view('backend.pdf.invoice_daily_report_pdf', compact('invoice_daily', 'start_date', 'end_date'));
	}




}
