@extends('admin.admin_master')
@section('title')
	All Unit
@endsection
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">

	<div class="col-12">
	 <div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">Units list</h3>
		  <a href="{{ route('units.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus-circle"> Add Unit</i></a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
			  <table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="10%">Sl. No.</th>
						<th >Name</th>
						<th width="15%">Status</th>
						<th width="25%">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($units as $row)
					<tr>
						<td>{{ @$loop->iteration }}</td>
						<td>{{ @$row->name }}</td>
						<td>
							<span class="badge badge-{{ @$row->status == 1 ? 'success' : 'danger' }}">{{ @$row->status == 1 ? 'active' : 'inactive' }}</span>
						</td>
						<td>
							@if($row->status == 0)
							<a href="{{ route('units.active', ['unit' => @$row->id]) }}" class="btn btn-success btn-sm" title="Active Now">Active</a>
							@else
							<a href="{{ route('units.inactive', ['unit' => @$row->id]) }}" class="btn btn-danger btn-sm" title="Inactive Data">Inactive</a>
							@endif
							<a href="{{ route('units.edit', ['unit' => @$row->id]) }}" class="btn btn-info btn-sm" title="Edit Data">Edit</a>
							<a href="{{ route('units.delete', ['unit' => @$row->id]) }}" id="delete" class="btn btn-warning btn-sm" title="Delete Data">Delete</a>
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