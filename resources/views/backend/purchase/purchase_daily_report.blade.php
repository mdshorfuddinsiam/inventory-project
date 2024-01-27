@extends('admin.admin_master')
@section('title')
	Create Category
@endsection
@section('content')

<!-- Content Header (Page header) -->
{{-- <div class="content-header">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="page-title">Advanced Form Elements</h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page">Forms</li>
						<li class="breadcrumb-item active" aria-current="page">Advanced Form Elements</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div> --}}

<!-- Main content -->
<section class="content">

  <div class="row">

	<div class="col-12">
	  <div class="box">
		  
		<div class="box-header">
			<h4 class="box-title">Create Category</h4>  
		</div>
		<div class="box-body">
			<form action="{{ route('purchases.daily.pdf') }}" target="_blank" method="GET">

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h5>Start Date <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="date" name="start_date" class="form-control" id="start_date" {{-- required --}}>
								@error('start_date')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>

						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5>End Date <span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="date" name="end_date" class="form-control" id="end_date" {{-- required --}}>
								@error('end_date')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>

						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<h5><span class="text-danger"></span></h5>
							<div class="controls" style="margin-top: 20px">
								<button type="submit" class="btn btn-rounded btn-primary ">Search</button>
							</div>

						</div>
					</div>
				</div>
				
			</form>
		</div>
		<!-- /.box-body -->
		  
	  </div>
	  <!-- /.box -->
	</div>
	<!-- ./col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

@endsection

@section('admin-js')
{{-- Select 2 --}}
<script src="{{ asset('') }}assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{ asset('') }}assets/vendor_components/select2/dist/js/select2.full.js"></script>
<script src="{{ asset('backend') }}/js/pages/advanced-form-element.js"></script>
@endsection