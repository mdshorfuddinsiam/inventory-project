@extends('admin.admin_master')
@section('title')
	Invoice Print (Pdf)
@endsection
@section('content')

{{-- <!-- Content Header (Page header) -->
<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="page-title">Invoice</h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page">Invoice</li>
						<li class="breadcrumb-item active" aria-current="page">Invoice Sample</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>   --}}

<div class="px-30 my-15 no-print">
  <div class="callout callout-success" style="margin-bottom: 0!important;">
	<h4><i class="fa fa-info"></i> Note:</h4>
	This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
  </div>
</div>

<!-- Main content -->
<section class="invoice printableArea">
	
	  <!-- title row -->
	  <div class="row">
		<div class="col-12">
		  <div class="bb-1 clearFix">
			<div class="text-right pb-15">
				<button class="btn btn-rounded btn-success" type="button"> <span><i class="fa fa-print"></i> Download</span> </button>
				<button id="print2" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
			</div>	
		  </div>
		</div>
		<div class="col-12">
		  <div class="page-header">
			<h2 class="d-inline"><span class="font-size-30">Invoice No: # {{ @$payment->invoice->invoice_no }}</span></h2>
			<div class="pull-right text-right">
				<h3>{{ date('d M Y', strtotime(@$payment->invoice->date)) }}</h3>
			</div>	
		  </div>
		</div>
		<!-- /.col -->
	  </div>
	  <!-- info row -->
	  <div class="row invoice-info">
		<div class="col-md-6 invoice-col">
		  {{-- <strong>From</strong>	 --}}
		  <address>
			<strong class="text-blue font-size-24">Sunny Admin</strong><br>
			<strong class="d-inline">North Shahjahanpur, Dhaka-1217.</strong><br>
			<strong>Phone: 01768553823 &nbsp;&nbsp;&nbsp;&nbsp; Email: sunnyadmin@gmail.com</strong>  
		  </address>
		</div>
		<!-- /.col -->
		<div class="col-md-6 invoice-col text-right">
		  {{-- <strong>To</strong>
		  <address>
			<strong class="text-blue font-size-24">Doe Shina</strong><br>
			124 Lorem Ipsum, Suite 478, Dummuy, USA 123456<br>
			<strong>Phone: (00) 789-456-1230 &nbsp;&nbsp;&nbsp;&nbsp; Email: conatct@example.com</strong>
		  </address> --}}
		</div>
		<!-- /.col -->
		<div class="col-sm-12 invoice-col mb-15">
			<div class="invoice-details row no-margin">
			  <div class="col-md-6 col-lg-4"><b>Customer Name: </b>{{ @$payment->customer->name }}</div>
			  <div class="col-md-6 col-lg-4"><b>Customer Mobile:</b> {{ @$payment->customer->mobile_no }}</div>
			  <div class="col-md-6 col-lg-4"><b>Customer Email:</b> {{ @$payment->customer->email }}</div>
			</div>
		</div>
	  <!-- /.col -->
	  </div>
	  <!-- /.row -->

	  <!-- Table row -->
	  <div class="row">
		<div class="col-12 table-responsive">
		  <table class="table table-bordered">
			<tbody>
			<tr>
			  <th>#</th>
			  <th>Category</th>
			  <th>Product Name</th>
			  <th class="text-right">Current Stock</th>
			  <th class="text-right">Quantity</th>
			  <th class="text-right">Unit Price</th>
			  <th class="text-right">Total Price</th>
			</tr>
			@php
				$invoice_details_sum = 0;
			@endphp
			@foreach($invoiceDetails as $row)
			<tr>
			  <td>1</td>
			  <td>{{ @$row->category->name }}</td>
			  <td>{{ @$row->product->name }}</td>
			  <td class="text-right">{{ @$row->product->quantity }}</td>
			  <td class="text-right">{{ @$row->selling_qty }}</td>
			  <td class="text-right">${{ @$row->unit_price }}</td>
			  <td class="text-right">${{ @$row->selling_price }}</td>
			</tr>
			@php
				$invoice_details_sum += $row->selling_price;
			@endphp
			@endforeach
			</tbody>
		  </table>
		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->

	  <div class="row">
		<div class="col-12 text-right">
			{{-- <p class="lead"><b>Payment Due</b><span class="text-danger"> 14/08/2018 </span></p> --}}

			<div>
				<p>Sub - Total amount  :  ${{ $invoice_details_sum }}</p>
				<p>Discount Amount  :  ${{ @$payment->discount_amount }}</p>
				<p>Paid Amount  :  ${{ @$payment->paid_amount }}</p>
				<p>Due Amount  :  ${{ @$payment->due_amount }}</p>
			</div>
			<div class="total-payment">
				<h3><b>Total :</b> ${{ @$payment->total_amount }}</h3>
			</div>

		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->


	    <!-- Table row -->
	    <div class="row">
	  	<div class="col-12 table-responsive">
	  	  <table class="table table-bordered text-center">
	  		<tbody>
	  		<tr>
	  			<th colspan="3">Paid History</th>
	  		</tr>
	  		<tr>
	  		  <th>#</th>
	  		  <th>Date</th>
	  		  <th>Current Paid Amount</th>
	  		</tr>
	  		@foreach($paymentDetails as $row)
	  		<tr>
	  		  <td>1</td>
	  		  <td>{{ date('d M, Y', strtotime(@$row->date)) }}</td>
	  		  <td>{{ @$row->current_paid_amount }}</td>
	  		</tr>
	  		@endforeach
	  		</tbody>
	  	  </table>
	  	</div>
	  	<!-- /.col -->
	    </div>
	    <!-- /.row -->



	  <!-- this row will not appear when printing -->
	  {{-- <div class="row no-print">
		<div class="col-12">
		  <button type="button" class="btn btn-rounded btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
		  </button>
		</div>
	  </div> --}}
		
</section>
<!-- /.content -->

@endsection

@section('admin-js')
	{{-- Invoice JS --}}
    <script src="{{ asset('/') }}assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js"></script>
	<script src="{{ asset('backend') }}/js/pages/invoice.js"></script>
@endsection
