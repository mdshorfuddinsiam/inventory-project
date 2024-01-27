@extends('admin.admin_master')
@section('title')
	Stock Report
@endsection
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">

	<div class="col-12">
	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Stock Report All</h3>
		  <a href="{{ route('stock.report.pdf') }}" class="btn btn-primary float-right" target="_blank"><i class="fa fa-print"> &nbsp;Stock Report Print</i></a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Supplier Name</th>
						<th>Unit Name</th>
						<th>Category Name</th>
						<th>Product Name</th>
						<th>In Qty</th>
						<th>Out Qty</th>
						<th>Quantity</th>
					</tr>
				</thead>
				<tbody>
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
						<td><span class="btn btn-success">{{ @$buying_qty }}</span></td>
						<td><span class="btn btn-info">{{ @$selling_qty }}</span></td>
						<td><span class="btn btn-danger">{{ @$row->quantity }}</span></td>
					</tr>
					@endforeach

				</tbody>
				{{-- <tfoot>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</tfoot> --}}
			  </table>
			</div>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

@endsection

@section('admin-js')
{{-- Data Table --}}
<script src="{{ asset('') }}assets/vendor_components/datatable/datatables.min.js"></script>
<script src="{{ asset('backend') }}/js/pages/data-table.js"></script>
@endsection