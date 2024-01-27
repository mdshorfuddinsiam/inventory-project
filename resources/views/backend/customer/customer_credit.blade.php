@extends('admin.admin_master')
@section('title')
	Credit Customer All
@endsection
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">

	<div class="col-12">
	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Credit Customer list</h3>
		  <a href="{{ route('customer.credit.pdf') }}" target="_blank" class="btn btn-primary float-right"><i class="fa fa-print"> &nbsp;Print Credit Customer</i></a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Customer Name</th>
						<th>Invoice No</th>
						<th>Date</th>
						<th>Due Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($creditCustomers as $row)
					<tr>
						<td>{{ @$loop->iteration }}</td>
						<td>{{ @$row->customer->name }}</td>
						<td>#{{ @$row->invoice->invoice_no }}</td>
						<td>{{ date('d-m-Y', strtotime(@$row->invoice->date)) }}</td>
						<td>${{ @$row->due_amount }}</td>
						<td>
							<a href="{{ route('customer.invoice.edit', @$row->invoice_id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-edit"></i></a>
							<a href="{{ route('customer.invoice.details', @$row->invoice_id) }}" target="_blank" class="btn btn-success btn-sm" title="View Invoice Details"><i class="fa fa-eye"></i></a>
						</td>
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