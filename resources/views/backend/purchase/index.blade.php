@extends('admin.admin_master')
@section('title')
	All Purchase
@endsection
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">

	<div class="col-12">
	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Purchase list</h3>
		  <a href="{{ route('purchases.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus-circle"> Add Purchase</i></a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Purchase No</th>
						<th>Data</th>
						<th>Supplier</th>
						<th>Category</th>
						<th>Qty</th>
						<th>Product Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($purchases as $row)
					<tr>
						<td>{{ @$loop->iteration }}</td>
						<td>{{ @$row->purchase_no }}</td>
						{{-- <td>{{ @$row->date }}</td> --}}
						<td>{{ date('d-m-Y', strtotime(@$row->date)) }}</td>
						<td>{{ @$row->supplier->name }}</td>
						<td>{{ @$row->category->name }}</td>
						<td>{{ @$row->buying_qty }}</td>
						<td>{{ @$row->product->name }}</td>
						<td>
							<span class="badge badge-{{ @$row->status == 1 ? 'success' : 'warning' }}">{{ @$row->status == 1 ? 'Approved' : 'Pending' }}</span>
						</td>
						<td>
							{{-- @if($row->status == 0)
							<a href="{{ route('purchases.active', ['purchase' => @$row->id]) }}" class="btn btn-success btn-sm" title="Active Now">Active</a>
							@else
							<a href="{{ route('purchases.inactive', ['purchase' => @$row->id]) }}" class="btn btn-danger btn-sm" title="Inactive Data">Inactive</a>
							@endif
							<a href="{{ route('purchases.edit', ['purchase' => @$row->id]) }}" class="btn btn-info btn-sm" title="Edit Data">Edit</a> --}}
							@if($row->status == '0')
							<a href="{{ route('purchases.delete', ['purchase' => @$row->id]) }}" id="delete" class="btn btn-danger btn-sm" title="Delete Data">Delete</a>
							@endif
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