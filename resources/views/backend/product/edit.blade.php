@extends('admin.admin_master')
@section('title')
	Edit Product
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
			<h4 class="box-title">Edit Product</h4>  
		</div>
		<div class="box-body">
			<form action="{{ route('products.update', ['product' => @$product->id]) }}" method="POST">
				@csrf
				@method('PUT')

				<div class="form-group row">
					<label class="col-form-label col-md-2">Supplier Name</label>
					<div class="col-md-4">
						<select name="supplier_id" class="form-control select2" style="width: 100%;">
						  <option selected="selected" disabled hidden="">Select One</option>
						  @foreach($suppliers as $row)
						  <option {{ $row->id == $product->supplier_id ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
						  @endforeach
						</select>
						@error('supplier_id')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Unit Name</label>
					<div class="col-md-4">
						<select name="unit_id" class="form-control select2" style="width: 100%;">
						  <option selected="selected" disabled hidden="">Select One</option>
						  @foreach($units as $row)
						  <option {{ $row->id == $product->unit_id ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
						  @endforeach
						</select>
						@error('unit_id')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Category Name</label>
					<div class="col-md-4">
						<select name="category_id" class="form-control select2" style="width: 100%;">
						  <option selected="selected" disabled hidden="">Select One</option>
						  @foreach($categories as $row)
						  <option {{ $row->id == $product->category_id ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->name }}</option>
						  @endforeach
						</select>
						@error('category_id')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Name</label>
					<div class="col-md-10">
						<input class="form-control" type="text" name="name" value="{{ @$product->name }}">
						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-2">Status</label>
					<div class="col-md-4">
						<select name="status" class="form-control select2" style="width: 100%;">
						  <option selected="selected" disabled hidden="">Select One</option>
						  <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
						  <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
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
@endsection