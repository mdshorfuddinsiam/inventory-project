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

{{-- <div class="px-30 my-15 no-print">
  <div class="callout callout-success" style="margin-bottom: 0!important;">
	<h4><i class="fa fa-info"></i> Note:</h4>
	This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
  </div>
</div> --}}

<!-- Main content -->
<section class="invoice printableArea">
	
	  <!-- title row -->
	  <div class="row">
		<div class="col-12">
		  <div class="bb-1 clearFix">
			<div class="text-right pb-15">
				<button class="btn btn-rounded btn-dark" type="button"> <span><i class="fa fa-list"></i> &nbsp;Back</span> </button>
				{{-- <button id="print2" class="btn btn-rounded btn-warning" type="button"> <span><i class="fa fa-print"></i> Print</span> </button> --}}
			</div>	
		  </div>
		</div>
		<div class="col-12">
		  <div class="page-header">
			<h2 class="d-inline"><span class="font-size-30">Invoice No: # {{ @$editData->invoice->invoice_no }}</span></h2>
			<div class="pull-right text-right">
				<h3>{{ date('d M Y', strtotime(@$editData->invoice->date)) }}</h3>
			</div>	
		  </div>
		</div>
		<!-- /.col -->
	  </div>
	  <!-- info row -->
	  <div class="row invoice-info">
		<div class="col-md-6 invoice-col">
		  {{-- <strong>From</strong>	 --}}
		  {{-- <address>
			<strong class="text-blue font-size-24">Sunny Admin</strong><br>
			<strong class="d-inline">North Shahjahanpur, Dhaka-1217.</strong><br>
			<strong>Phone: 01768553823 &nbsp;&nbsp;&nbsp;&nbsp; Email: sunnyadmin@gmail.com</strong>  
		  </address> --}}
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
			  <div class="col-md-6 col-lg-4"><b>Customer Name: </b>{{ @$editData->customer->name }}</div>
			  <div class="col-md-6 col-lg-4"><b>Customer Mobile:</b> {{ @$editData->customer->mobile_no }}</div>
			  <div class="col-md-6 col-lg-4"><b>Customer Email:</b> {{ @$editData->customer->email }}</div>
			{{--   <div class="col-md-6 col-lg-3"><b>Description:</b> {{ @$invoice->description }}</div> --}}
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
				$invoice_sum = 0;
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
				$invoice_sum += $row->selling_price;
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
				<p>Sub - Total amount  :  ${{ $invoice_sum }}</p>
				<p>Discount Amount  :  ${{ @$editData->discount_amount }}</p>
				<p>Paid Amount  :  ${{ @$editData->paid_amount }}</p>
				<p>Due Amount  :  ${{ @$editData->due_amount }}</p>
			</div>
			<div class="total-payment">
				<h3><b>Total :</b> ${{ @$editData->total_amount }}</h3>
			</div>

		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->

	  	<form action="{{ route('customer.invoice.update', $editData->invoice_id) }}" method="POST">
	  	  @csrf
	  	  <div class="row">
	  		<input type="hidden" name="old_due_amount" value="{{ @$editData->due_amount }}">
		  	<div class="col-md-3">
				<div class="form-group">
					<h5>Paid Status <span class="text-danger">*</span></h5>
					<div class="controls">
						<select name="paid_status" id="paid_status" {{-- required="" --}} class="form-control select2" style="width: 100%;" aria-invalid="false">
							<option value="" selected disabled hidden="">Select One</option>
							<option value="full_paid">Full Paid</option>
							<option value="partial_paid">Partial Paid</option>
						</select>
						<input type="text" class="form-control d-none paid_amount" name="paid_amount" id="paid_amount" placeholder="Enter Paid Amount">
				    </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<h5>Date <span class="text-danger">*</span></h5>
					<div class="controls">
						<input type="date" name="date" class="form-control" id="date" value="{{ date('Y-m-d') }}" required>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-info btn-rounded mt-20">Update</button>
			</div>
	      </div>
		</form>	

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
{{-- Select 2 --}}
<script src="{{ asset('') }}assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{ asset('') }}assets/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="{{ asset('backend') }}/js/pages/advanced-form-element.js"></script>
<script>
	$(document).on('change', '#paid_status', function(){
		var paid_status = $(this).val();
		if(paid_status == 'partial_paid'){
			$('#paid_amount').removeClass('d-none');
		}else{
			$('#paid_amount').addClass('d-none');
		}
	});
</script>
@endsection
