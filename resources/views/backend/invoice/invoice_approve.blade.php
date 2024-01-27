@extends('admin.admin_master')
@section('title')
	All Invoice
@endsection
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">

	<div class="col-12">
	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Invoice Approve</h3>
		  <a href="{{ route('invoices.pending.list') }}" class="btn btn-primary float-right"><i class="fa fa-list"> &nbsp;Pending List</i></a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<h4>Invoice No: #{{ @$invoice->invoice_no }} - {{ date('d-m-Y', strtotime(@$invoice->date)) }}</h4>
			<div class="table-responsive">
			  <table class="table mb-0">
				  <thead class="thead-light">
					<tr>
					  <th scope="col">Customer Information :</th>
					  <th scope="col">Name: {{ @$payment->customer->name }}</th>
					  <th scope="col">Phone: {{ @$payment->customer->mobile_no }}</th>
					  <th scope="col">Email: {{ @$payment->customer->email }}</th>
					</tr>
				  </thead>
				  <tbody style="background-color: #1a233a;">
					<tr>
					  <th colspan="2"></th>
					  <th>Description: {{ @$invoice->description }}</th>
					  <th></th>
					</tr>
				  </tbody>
				</table>
			</div>
		</div>
		<!-- /.box-body -->

		

	  </div>
	  <!-- /.box -->
	</div>
	<!-- /.col -->

	<div class="col-12">
	 <div class="box">

		<div class="box-body">
			<div class="table-responsive">

				<form action="{{ route('invoices.approval.store', ['invoice' => $invoice->id]) }}" method="POST">
				  @csrf
				  <table class="table mb-0" >
					  <thead class="thead-light">
						<tr>
						  <th scope="col">Sl. No.</th>
						  <th scope="col">Category</th>
						  <th scope="col">Product Name</th>
						  <th scope="col" style="background-color: #8B008B">Current Stock</th>
						  <th scope="col">Quantity</th>
						  <th scope="col">Unit Price</th>
						  <th scope="col">Total Price</th>
						</tr>
					  </thead>
					  <tbody style="background-color: #1a233a;">
					  	@php
					  		$invoice_sum = 0;
					  	@endphp
					  	@foreach($invoice->invoice_details as $row)
						<tr>

						  <input type="hidden" name="category_id[]" id="category_id" value="{{ @$row->category_id }}">
						  <input type="hidden" name="product_id[]" id="product_id" value="{{ @$row->product_id }}">
						  <input type="hidden" name="selling_qty[{{ $row->id }}]" id="selling_qty" value="{{ @$row->selling_qty }}">

						  <td>{{ $loop->iteration }}</td>
						  <td>{{ @$row->category->name }}</td>
						  <td>{{ @$row->product->name }}</td>
						  <td style="background-color: #8B008B">{{ @$row->product->quantity }}</td>
						  <td>{{ @$row->selling_qty }}</td>
						  <td>{{ @$row->unit_price }}</td>
						  <td>{{ @$row->selling_price }}</td>
						</tr>
						@php
							$invoice_sum += @$row->selling_price;
						@endphp
						@endforeach
						<tr>
							<td colspan="6">Sub Total</td>
							<td>{{ $invoice_sum }}</td>
						</tr>
						<tr>
							<td colspan="6">Discount</td>
							<td>{{ @$payment->discount_amount }}</td>
						</tr>
						<tr>
							<td colspan="6">Paid Amount</td>
							<td>{{ @$payment->paid_amount }}</td>
						</tr>
						<tr>
							<td colspan="6">Due Amount</td>
							<td>{{ @$payment->due_amount }}</td>
						</tr>
						<tr>
							<td colspan="6">Grand Total</td>
							<td>{{ @$payment->total_amount }}</td>
						</tr>
					  </tbody>
				   </table>
				   <br>
				   <button type="submit" class="btn btn-info">Approve Invoice</button>
				</form>

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
{{-- sweet alert 2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).on('click', '#delete' , function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.isConfirmed) {
		    	window.location.href = url;
		    Swal.fire(
		      'Deleted!',
		      'Your file has been deleted.',
		      'success'
		    )
		  }
		})
    });
</script>
@endsection