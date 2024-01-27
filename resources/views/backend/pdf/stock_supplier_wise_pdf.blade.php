@extends('admin.admin_master')
@section('title')
	Stock Supplier Wise Report (Pdf)
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
			<h2 class="d-inline"><span class="font-size-30">Stock Supplier Wise Report</span></h2>
			<div class="pull-right text-right">
				{{-- <h3>{{ date('d M Y', strtotime(@$invoice->date)) }}</h3> --}}
				{{-- <span class="btn btn-rounded btn-info">{{ date('d-m-Y', strtotime(@$start_date)) }}</span> &nbsp;-&nbsp; 
				<span class="btn btn-rounded btn-success">{{ date('d-m-Y', strtotime(@$end_date)) }}</span> --}}
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
	  </div>
	  <!-- /.row -->

	  <!-- Table row -->
	  <div class="row">
		<div class="col-12 table-responsive">
	  	  <h3 class="text-center">Supplier Name: {{ $products[0]['supplier']['name'] }}</h3>
		  <table class="table table-bordered">
			<tbody>
			<tr>
			  <th>#</th>
			  <th>Supplier Name</th>
			  <th>Unit Name</th>
			  <th>Category Name</th>
			  <th>Product Name</th>
			  <th>In Qty</th>
			  <th>Out Qty</th>
			  <th>Quantity</th>
			</tr>
			@foreach($products as $row)
			@php
				$buying_qty = \App\Models\Purchase::where('product_id', $row->id)->whereStatus('1')->sum('buying_qty');
				$selling_qty = \App\Models\InvoiceDetail::where('product_id', $row->id)->whereStatus('1')->sum('selling_qty');
			@endphp
			<tr>
			  <td>{{ @$loop->iteration }}</td>
			  <td>{{ @$row->supplier->name }}</td>
			  <td>{{ @$row->unit->name }}</td>
			  <td>{{ @$row->category->name }}</td>
			  <td>{{ @$row->name }}</td>
			  <td>{{ @$buying_qty }}</td>
			  <td>{{ @$selling_qty }}</td>
			  <td>{{ @$row->quantity }}</td>
			</tr>
			@endforeach
			</tbody>
		  </table>
		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->

	  <div class="row">
		<div class="col-12 text-right">
			<div class="total-payment">
				@php
					$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
				@endphp
				<h3><b>Printing Time :</b> {{ $date->format('F j, Y, g:i a') }}</h3>
			</div>

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
