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

		  <div class="row">
			<div class="col-md-12 text-center">
				<div class="form-group validate">
					<fieldset class="controls">
						<input name="supplier_product_wise" type="radio" id="supplier_wise" value="supplier_wise" class="search_value">
						<label for="supplier_wise">Supplier Wise Report</label>

						<input name="supplier_product_wise" type="radio" id="product_wise" value="product_wise" class="search_value">
						<label for="product_wise">Product Wise Report</label>							
					</fieldset>
				</div>
			</div>
		  </div>

		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			  {{-- Supplier Wise Report Form --}}
			  <form id="showSupplierForm" action="{{ route('stock.supplier.wise.pdf') }}" target="_blank" method="GET" style="display: none;">

				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<h5>Supplier Name <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="supplier_id" class="form-control select2" style="width: 100%;">
								  <option selected="selected" disabled hidden="">Select One</option>
								  @foreach($suppliers as $row)
								  <option value="{{ $row->id }}">{{ $row->name }}</option>
								  @endforeach
								</select>
								@error('supplier_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<h5><span class="text-danger"></span></h5>
							<div class="controls" style="margin-top: 21px">
								<button type="submit" class="btn btn-rounded btn-primary ">Search</button>
							</div>
						</div>
					</div>
				</div>
					
			  </form>

			    {{-- Product Wise Report Form --}}
			    <form id="showProductForm" action="{{ route('stock.product.wise.pdf') }}" target="_blank" method="GET" style="display: none;">

				  	<div class="row">
				  		<div class="col-md-4">
				  			<div class="form-group">
				  				<h5>Category Name <span class="text-danger">*</span></h5>
				  				<div class="controls">
				  					<select name="category_id" id="category_id" required="" class="form-control select2" style="width: 100%;" aria-invalid="false">
				  						<option value="" selected disabled hidden="">Select One</option>
				  						@foreach($categories as $row)
				  						<option value="{{ $row->id }}">{{ $row->name }}</option>
				  						@endforeach
				  					</select>
				  					@error('category_id')
				  						<span class="text-danger">{{ $message }}</span>
				  					@enderror
				  			    </div>
				  			</div>
				  		</div>
				  		<div class="col-md-4">
				  			<div class="form-group">
				  				<h5>Product Name <span class="text-danger">*</span></h5>
				  				<div class="controls">
				  					<select name="product_id" id="product_id" required="" class="form-control select2" style="width: 100%;" aria-invalid="false">
				  						<option value="" selected disabled hidden="">Select One</option>

				  					    
				  					</select>
				  					@error('product_id')
				  						<span class="text-danger">{{ $message }}</span>
				  					@enderror
				  			    </div>
				  			</div>
				  		</div>
				  		<div class="col-md-4">
				  			<div class="form-group">
				  				<h5><span class="text-danger"></span></h5>
				  				<div class="controls" style="margin-top: 21px">
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
	<!-- /.col -->

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
<script>
	$(document).on('change', '[name="supplier_product_wise"]', function(){
		var value = $(this).val();
		if(value == 'supplier_wise'){
			$('#showSupplierForm').show();
		}else{
			$('#showSupplierForm').hide();
		}
	});
</script>
<script>
	$(document).on('change', '[name="supplier_product_wise"]', function(){
		var value = $(this).val();
		if(value == 'product_wise'){
			$('#showProductForm').show();
		}else{
			$('#showProductForm').hide();
		}
	});
</script>
<script>
	$(document).on('change', '#category_id', function(){
		var category_id = $(this).val();
		// console.log(category_id);

		$.ajax({
           url:"{{ route('get-product') }}",
           type: "POST",
           data:{category_id:category_id},
           success:function(data){
           	   $('#product_id').empty();
               var html = '<option value="" selected disabled hidden="">Select Product</option>';
               $.each(data, function(key,value){
           		   // console.log(key);
               		html += '<option value="'+value.id+'"> '+value.name+'</option>';
               });
               $('#product_id').append(html);
           }
       });

	});
</script>
<script>
	$(document).on('change', '#product_id', function(){
		var product_id = $(this).val();
		// console.log(product_id);

		$.ajax({
           url:"{{ route('get-product-stock') }}",
           type: "POST",
           data:{product_id:product_id},
           success:function(data){
               $('#current_stock_quantity').val(data);
           }
       });

	});
</script>
@endsection