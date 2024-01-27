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
		  {{-- <a href="{{ route('invoices.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus-circle"> Add Invoice</i></a> --}}
		  <a href="{{ route('invoices.index') }}" class="btn btn-primary float-right"><i class="fa fa-list"> Invoice List</i></a>
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
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pendingList as $row)
					<tr>
						<td>{{ @$loop->iteration }}</td>
						<td>{{ @$row->payment->customer->name }}</td>
						<td>{{ @$row->invoice_no }}</td>
						<td>{{ date('d-m-Y', strtotime(@$row->date)) }}</td>
						<td>{{ @$row->description }}</td>
						<td>
							$ {{ @$row->payment->total_amount }}
						</td>
						<td>
							<span class="badge badge-{{ @$row->status == 0 ? 'warning' : 'success' }}">{{ @$row->status == 0 ? 'Pending' : 'Approved' }}</span>
						</td>
						<td>
							<a href="{{ route('invoices.approve', ['invoice' => @$row->id]) }}" id="approve" class="btn btn-primary btn-sm" title="Approve Now"><i class="fa fa-check-circle"></i></a>
							<a href="{{ route('invoices.delete', ['invoice' => @$row->id]) }}" id="delete" class="btn btn-danger btn-sm" title="Delete Now"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript">
    $(document).on('click', '#approve' , function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, approve it!'
		}).then((result) => {
		  if (result.isConfirmed) {
		    	window.location.href = url;
		    Swal.fire(
		      'Approved!',
		      'Your invoice has been approve.',
		      'success'
		    )
		  }
		})
    });
</script>
@endsection