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
		  <h3 class="box-title">Invoice list</h3>
		  <a href="{{ route('invoices.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus-circle"> Add Invoice</i></a>
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
						<th>Description</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					@foreach($invoices as $row)
					<tr>
						<td>{{ @$loop->iteration }}</td>
						<td>{{ @$row->payment->customer->name }}</td>
						<td>{{ @$row->invoice_no }}</td>
						<td>{{ date('d-m-Y', strtotime(@$row->date)) }}</td>
						<td>{{ @$row->description }}</td>
						<td>
							{{-- @if($row->status == '0')
							<a href="{{ route('invoices.delete', ['invoice' => @$row->id]) }}" id="delete" class="btn btn-danger btn-sm" title="Delete Data">Delete</a>
							@endif --}}
							$ {{ @$row->payment->total_amount }}
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