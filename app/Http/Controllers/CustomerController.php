<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = cache()->rememberForever('customers', function(){
            return Customer::latest()->get();
        });
        return view('backend.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
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
            'mobile_no' => 'required|unique:customers',
            'email' => 'required|unique:customers',
            'address' => 'required',
            // 'image' => 'required',
        ],[
            'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;

        if($request->file('image')){
            $file = $request->file('image');
            $imageName = 'customer_image-'.uniqid().rand(1000, 99999).$file->getClientOriginalExtension();
            $directory = 'upload/customer-images/';
            Image::make($file)->resize(200, 200)->save($directory.$imageName);
            $data['image'] = $directory.$imageName;

            Customer::create($data);
            $notification = [
                'message'       => 'Customer inserted with image successfully!!',
                'alert-type'    => 'success',
            ];
            return redirect()->route('customers.index')->with($notification);
        }
        else{
            $data['image'] = '';
            Customer::create($data);
            $notification = [
                'message'       => 'Customer inserted without image successfully!!',
                'alert-type'    => 'success',
            ];
            return redirect()->route('customers.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|max:255',
            'mobile_no' => 'required',
            'email' => 'required',
            'address' => 'required',
            // 'image' => 'required',
        ],[
            'name' => 'Name field must be required',
        ]);

        $data = [];
        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;

        if($request->file('image')){
            if(file_exists($customer->image)){
                unlink($customer->image);
            }
            $file = $request->file('image');
            $imageName = 'customer_image-'.uniqid().rand(1000, 99999).$file->getClientOriginalExtension();
            $directory = 'upload/customer-images/';
            Image::make($file)->resize(200, 200)->save($directory.$imageName);
            $data['image'] = $directory.$imageName;
        }
        else{
            $data['image'] = $customer->image;
        }

        $customer->update($data);
        $notification = [
            'message'       => 'Customer updated successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('customers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function delete(Customer $customer)
    {
        if(file_exists($customer->image)){
            unlink($customer->image);
        }
        $customer->delete($customer);
        $notification = [
            'message'       => 'Customer deleted successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('customers.index')->with($notification);
    }

    public function active(Customer $customer)
    {
        $customer->update([
            'status' => '1',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Customer status active successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('customers.index')->with($notification);
    }

    public function inactive(Customer $customer)
    {
        $customer->update([
            'status' => '0',
            'updated_by' => auth()->user()->id,
        ]);
        $notification = [
            'message'       => 'Customer status inactive successfully!!',
            'alert-type'    => 'success',
        ];
        return redirect()->route('customers.index')->with($notification);
    }

    public function creditCustomer(){
        $creditCustomers = Payment::with('customer', 'invoice')->whereIn('paid_status', ['partial_paid', 'full_due'])->get();
        return view('backend.customer.customer_credit', compact('creditCustomers'));
    }

    public function creditCustomerPdf(){
        $creditCustomers = Payment::with('customer', 'invoice')->whereIn('paid_status', ['partial_paid', 'full_due'])->get();
        return view('backend.pdf.customer_credit_pdf', compact('creditCustomers'));
    }

    public function customerInvoiceEdit($invoice_id){
        $editData = Payment::with('customer', 'invoice')->where('invoice_id', $invoice_id)->first();
        $invoiceDetails = InvoiceDetail::with('category', 'product')->where('invoice_id', $invoice_id)->get();
        return view('backend.customer.customer_invoice_edit', compact('editData', 'invoiceDetails'));
    }

    public function customerInvoiceUpdate(Request $request,$invoice_id){
        if($request->paid_amount > $request->old_due_amount){
            $notification = [
                'message'       => 'Paid Amount is Maximum then Due Amount!!',
                'alert-type'    => 'error',
            ];
            return redirect()->back()->with($notification);
        }
        else{
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $paymentDetail = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if($request->paid_status == 'full_paid'){
                $payment->paid_amount = $payment->paid_amount + $request->old_due_amount;
                $payment->due_amount = '0';
                $paymentDetail->current_paid_amount = $request->old_due_amount;
            }elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = $payment->paid_amount + $request->paid_amount;
                $payment->due_amount = $payment->due_amount - $request->paid_amount;
                $paymentDetail->current_paid_amount = $request->paid_amount;
            } 

            $payment->save();
            $paymentDetail->invoice_id = $invoice_id;
            $paymentDetail->date = date('Y-m-d', strtotime($request->date));
            $paymentDetail->updated_by = auth()->user()->id;
            $paymentDetail->save();
            $notification = [
                'message'       => 'Invoice updated successfully!!',
                'alert-type'    => 'success',
            ];
            return redirect()->route('customer.credit')->with($notification);
        }
    }

    public function customerInvoiceDetails($invoice_id){
        $payment = Payment::with('customer', 'invoice')->where('invoice_id', $invoice_id)->first();
        $invoiceDetails = InvoiceDetail::with('category', 'product')->where('invoice_id', $invoice_id)->get();
        $paymentDetails = PaymentDetail::where('invoice_id', $invoice_id)->get();
        return view('backend.pdf.customer_invoice_details_pdf', compact('payment', 'invoiceDetails', 'paymentDetails'));
    }

    public function paidCustomer(){
        $paidCustomers = Payment::with('customer', 'invoice')->where('paid_status', '!=', 'full_due')->get();
        return view('backend.customer.customer_paid', compact('paidCustomers'));
    }

    public function paidCustomerPdf(){
        $paidCustomers = Payment::with('customer', 'invoice')->where('paid_status', '!=', 'full_due')->get();
        return view('backend.pdf.customer_paid_pdf', compact('paidCustomers'));
    }

    public function customerWiseReport(){
        $customers = Customer::orderBy('name', 'asc')->get();
        return view('backend.customer.customer_wise_report', compact('customers'));
    }

    public function customerWiseCreditPdf(Request $request){
        $customerWiseCredit = Payment::with('customer', 'invoice')->where('customer_id', $request->customer_id)->whereIn('paid_status', ['partial_paid','full_due'])->get();
        return view('backend.pdf.customer_wise_credit_pdf', compact('customerWiseCredit'));
    }

    public function customerWisePaidPdf(Request $request){
        $customerWisePaid = Payment::with('customer', 'invoice')->where('customer_id', $request->customer_id)->where('paid_status', '!=', 'full_due')->get();
        return view('backend.pdf.customer_wise_paid_pdf', compact('customerWisePaid'));
    }


}
