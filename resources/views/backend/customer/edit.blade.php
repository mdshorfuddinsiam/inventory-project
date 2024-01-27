@extends('admin.admin_master')
@section('title')
	Edit Customer
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
			<h4 class="box-title">Create Customer</h4>  
		</div>
		<div class="box-body">
			<form action="{{ route('customers.update', ['customer' => @$customer->id]) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="form-group row">
					<label class="col-form-label col-md-2">Name</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="name" value="{{ @$customer->name }}">
						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Mobile Number</label>
					<div class="col-md-10">
						<input class="form-control" type="number" name="mobile_no" value="{{ @$customer->mobile_no }}">
						@error('mobile_no')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Email</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="email" value="{{ @$customer->email }}">
						@error('email')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Address</label>
					<div class="col-md-10">
						<textarea name="address" id="" cols="80" rows="5">{{ @$customer->address }}</textarea>
						<br>
						@error('address')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2">Customer Image</label>
					<div class="col-lg-10">
						<input type="file" name="image" id="image" class="form-control">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-2"></label>
					<div class="col-lg-10">
						<img src="{{ @$customer->image == null ? asset('upload/no_image.jpg') : asset(@$customer->image) }}" id="showImage" width="50" height="50" alt="">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Status</label>
					<div class="col-md-4">
						<select name="status" class="form-control select2" style="width: 100%;">
						  <option selected="selected" disabled hidden="">Select One</option>
						  <option {{ @$customer->status == 1 ? 'selected' : '' }} value="1">Active</option>
						  <option {{ @$customer->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
						</select>
					</div>
				</div>

				<br>
				<div class="form-group row">
					<label class="col-form-label col-md-2"></label>
					<div class="col-md-10">
						<button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
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
<script type="text/javascript">      
	$(document).ready(function (e) {
	   $('#image').change(function(){          
	    let reader = new FileReader();
	    reader.onload = (e) => { 
	      $('#showImage').attr('src', e.target.result); 
	    }
	    reader.readAsDataURL(this.files[0]); 
	   }); 
	});
</script>
@endsection