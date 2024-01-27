<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = cache()->rememberForever('purchases', function(){
            return Purchase::with('supplier', 'category', 'product')->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        });
        return view('backend.purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::orderBy('name', 'asc')->get();
        return view('backend.purchase.create', compact('suppliers'));
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
        if($request->category_id == null){
            $notification = [
                'message' => 'Sorry you do not select any item!!',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
        else{
            $category_number = count($request->category_id);
            // dd($category_number);
            for($i=0; $i < $category_number; $i++){
                // dd($request->category_id[$i]);
                // dd(date('Y-m-d', strtotime($request->date[$i])));
                // dd($request->date[$i]);

                $purchase = new Purchase();
                // $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->date = $request->date[$i];
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];

                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];

                $purchase->created_by = auth()->user()->id;
                $purchase->status = '0';
                $purchase->save();
            }   
        }
        $notification = [
            'message' => 'Purchase data inserted successfully!!',
            'alert-type' => 'success'
        ];
        return redirect()->route('purchases.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    // Delete (pending purchase)
    public function delete(Purchase $purchase){
        $purchase->delete();
        $notification = [
            'message' => 'Purchase data deleted successfully!!',
            'alert-type' => 'success'
        ];
        return redirect()->route('purchases.index')->with($notification);
    }

    // Pending purchase
    public function pendingPurchase(){
        $pendingPurchase = Purchase::with('supplier', 'category', 'product')->orderBy('date', 'desc')->orderBy('id', 'desc')->whereStatus('0')->get();
        return view('backend.purchase.pending_purchase', compact('pendingPurchase'));
    }

    // Approve purchase
    public function approvePurchase(Purchase $purchase){
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty) + (float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            $purchase->update(['status' => '1']);
            $notification = [
                'message' => 'Purchase data approved successfully!!',
                'alert-type' => 'success'
            ];
            return redirect()->route('purchases.index')->with($notification);
        }
    }

    // Daily purchase report
    public function dailyPurchaseReport(){
        return view('backend.purchase.purchase_daily_report');
    }

    // Daily purchase pdf
    public function dailyPurchasePdf(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]); 

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        // dd($end_date);
        $purchase_daily = Purchase::with('product')->whereBetween('date', [$start_date, $end_date])->whereStatus('1')->get();
        return view('backend.pdf.purchase_daily_report_pdf', compact('purchase_daily', 'start_date', 'end_date'));
    }


}
