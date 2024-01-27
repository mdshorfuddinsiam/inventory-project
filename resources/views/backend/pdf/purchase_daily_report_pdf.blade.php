@extends('admin.admin_master')
@section('title')
	Purchase Daily Report (Pdf)
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
			<h2 class="d-inline"><span class="font-size-30">Daily Purchase Report</span></h2>
			<div class="pull-right text-right">
				{{-- <h3>{{ date('d M Y', strtotime(@$invoice->date)) }}</h3> --}}
				<span class="btn btn-rounded btn-info">{{ date('d-m-Y', strtotime(@$start_date)) }}</span> &nbsp;-&nbsp; 
				<span class="btn btn-rounded btn-success">{{ date('d-m-Y', strtotime(@$end_date)) }}</span>
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
		  <table class="table table-bordered">
			<tbody>
			<tr>
			  <th>#</th>
			  <th>Purchase No</th>
			  <th>Date</th>
			  <th>Product Name</th>
			  <th class="text-right">Quantity</th>
			  <th class="text-right">Unit Price</th>
			  <th class="text-right">Total Price</th>
			</tr>
			@php
				$purchase_sum = 0;
			@endphp
			@foreach($purchase_daily as $row)
			<tr>
			  <td>{{ @$loop->iteration }}</td>
			  <td>{{ @$row->purchase_no }}</td>
			  <td>{{ date('d-m-Y', strtotime(@$row->date)) }}</td>
			  <td>{{ @$row->product->name }}</td>
			  <td class="text-right">{{ @$row->buying_qty }} {{ @$row->product->unit->name }}</td>
			  <td class="text-right">${{ @$row->unit_price }}</td>
			  <td class="text-right">${{ @$row->buying_price }}</td>
			</tr>
			@php
				$purchase_sum += $row->buying_price;
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
			<div class="total-payment">
				<h3><b>Grand Total :</b> ${{ $purchase_sum }}</h3>
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