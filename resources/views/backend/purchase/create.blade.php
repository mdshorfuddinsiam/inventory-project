@extends('admin.admin_master')
@section('title')
	Create Purchase
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
			<h4 class="box-title">Create Purchase</h4>  
		</div>
		<div class="box-body">
			
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<h5>Date <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="date" name="date" class="form-control" id="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d')}}" required>
						</div>

					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<h5>Purchase No <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="text" name="purchase_no" class="form-control" id="purchase_no" required="" > 
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<h5>Supplier Name <span class="text-danger">*</span></h5>
						<div class="controls">
							<select name="supplier_id" id="supplier_id" required="" class="form-control select2" style="width: 100%;" aria-invalid="false">
								<option value="" selected disabled hidden>Select One</option>
							    @foreach($suppliers as $row)
							    <option value="{{ $row->id }}">{{ $row->name }}</option>
							    @endforeach
							</select>
					    </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<h5>Category Name <span class="text-danger">*</span></h5>
						<div class="controls">
							<select name="category_id" id="category_id" required="" class="form-control select2" style="width: 100%;" aria-invalid="false">
								<option value="" selected disabled hidden="">Select One</option>


							</select>
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
					    </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<h5>  <span class="text-danger"> </span></h5>
						<div class="controls">
							{{-- <input type="submit" class="btn btn-rounded btn-secondary mt-10" value="+ Add More" >  --}}
							<i class="btn btn-rounded btn-secondary mt-10 fa fa-plus-circle addeventmore" aria-hidden="true"> Add More</i>
						</div>
					</div>
				</div>
			</div> {{-- end row --}}

		</div>
		<!-- /.box-body -->
		{{-- =========================== --}}
		<div class="box-body">			
			<form action="{{ route('purchases.store') }}" method="POST">
				@csrf

				<table class="table table-bordered text-center" width="100%" {{-- style="border: 2px solid white" --}}>
					<thead>
						<tr>
							<th>Category</th>
							<th>Product Name</th>
							<th>PCS/KG</th>
							<th>Unit Price</th>
							<th>Description</th>
							<th>Total Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="addRow" class="addRow">
						
					</tbody>
					<tbody>
						<tr>
							<td colspan="5"></td>
							<td >
								<input type="number" name="estimated_amount" id="estimated_amount" class="form-control" value="0" readonly style="background-color: #ddd">
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>

				<button type="submit" class="btn btn-info mt-10" id="storeBtn">Purchase Store</button>

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
<!-- Include Handlebars from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
{{-- Notify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" ></script>

<script>
	$(document).on('change', '#supplier_id', function(){
		var supplier_id = $(this).val();
		// console.log(supplier_id);

		$.ajax({
           url:"{{ route('get-category') }}",
           type: "POST",
           data:{supplier_id:supplier_id},
           success:function(data){
           	   $('#category_id').empty();
               var html = '<option value="" selected disabled hidden="">Select Category</option>';
               $.each(data, function(key,value){
           		   // console.log(key);
                   html += '<option value="'+value.category_id+'"> '+value.category.name+'</option>';
               });
               $('#product_id').empty();
               $('#category_id').html(html);
           }
       });

	});
</script>
<script>
	$(document).on('change', '#category_id', function(){
		var category_id = $(this).val();
		// console.log(category_id);
		var supplier_id = $('#supplier_id').val();

		$.ajax({
           url:"{{ route('get-catewise-product') }}",
           type: "POST",
           data:{category_id:category_id, supplier_id:supplier_id},
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
<script id="document-template" type="text/x-handlebars-template">
  <tr id="delete_add_more_item" class="delete_add_more_item">
  		<input type="hidden" name="date[]" value="@{{date}}">
  		<input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
  		<input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
  	<td>
  		<input type="hidden" name="category_id[]" value="@{{category_id}}">
  		@{{category_name}}
  	</td>
  	<td>
  		<input type="hidden"  name="product_id[]" value="@{{product_id}}">
  		@{{product_name}}
  	</td>
  	<td>
  		<input type="number" required value="1" class="form-control buying_qty" name="buying_qty[]"  min="1">
  	</td>
  	<td>
  		<input type="number" required min="0" value="0" class="form-control unit_price" name="unit_price[]" >
  	</td>
  	<td>
  		<input type="text" class="form-control description" name="description[]" >
  	</td>
  	<td>
  		<input type="number" class="form-control buying_price" name="buying_price[]" value="0" readonly>
  	</td>
  	<td>
  		<i class="btn btn-danger fa fa-window-close removeeventmore" aria-hidden="true"></i>
  	</td>
  </tr>
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.addeventmore', function(){
			var date = $('#date').val();
			var purchase_no = $('#purchase_no').val();
			var supplier_id = $('#supplier_id').val();
			var category_id = $('#category_id').val();
			var category_name = $('#category_id').find('option:selected').text();
			var product_id = $('#product_id').val();
			var product_name = $('#product_id').find('option:selected').text();

			// alert(product_id);

			if(date == ''){
				$.notify("Date is required", {globalPosition: 'top-right', className: 'error'});
				return false;
			}
			if(purchase_no == ''){
				$.notify("Purchase No is required", {globalPosition: 'top-right', className: 'error'});
				return false;
			}
			if(supplier_id == null){
				$.notify("Supplier is required", {globalPosition: 'top-right', className: 'error'});
				return false;
			}
			if(category_id == null){
				$.notify("Category is required", {globalPosition: 'top-right', className: 'error'});
				return false;
			}
			if(product_id == null){
				$.notify("Product is required", {globalPosition: 'top-right', className: 'error'});
				return false;
			}

			var source = $("#document-template").html();
			var template = Handlebars.compile(source);
			var data = { 
				date:date,
				purchase_no:purchase_no,
				supplier_id:supplier_id,
				category_id:category_id,
				category_name:category_name,
				product_id:product_id,
				product_name:product_name,
			};
			var html = template(data);
			$('#addRow').append(html);

			// $('#addRow').append('<tr id="delete_add_more_item" class="delete_add_more_item">\
			//   		<input type="hidden" name="date[]" value="'+date+'">\
			//   		<input type="hidden" name="purchase_no[]" value="'+purchase_no+'">\
			//   		<input type="hidden" name="supplier_id[]" value="'+supplier_id+'">\
			//   	<td>\
			//   		<input type="hidden" name="category_id[]" value="'+category_id+'">\
			//   		'+category_name+'\
			//   	</td>\
			//   	<td>\
			//   		<input type="hidden" name="product_id[]" value="'+product_id+'">\
			//   		'+product_name+'\
			//   	</td>\
			//   	<td>\
			//   		<input type="number" class="form-control buying_qty" name="buying_qty[]"  min="1">\
			//   	</td>\
			//   	<td>\
			//   		<input type="number" class="form-control unit_price" name="unit_price[]" >\
			//   	</td>\
			//   	<td>\
			//   		<input type="text" class="form-control description" name="description[]" >\
			//   	</td>\
			//   	<td>\
			//   		<input type="number" class="form-control buying_price" name="buying_price[]"\ value="0" readonly>\
			//   	</td>\
			//   	<td>\
			//   		<i class="btn btn-danger fa fa-window-close removeeventmore" aria-hidden="true"></i>\
			//   	</td>\
			//   </tr>');
		});

		$(document).on('click', '.removeeventmore', function(){
			$(this).closest('.delete_add_more_item').remove();
			totalAmountPrice();
		});

		$(document).on('click keyup', '.buying_qty, .unit_price', function(){
			var buying_qty = $(this).closest('tr').find('input.buying_qty').val();
			var unit_price = $(this).closest('tr').find('input.unit_price').val();
			var buying_price = buying_qty * unit_price;
			$(this).closest('tr').find('input.buying_price').val(buying_price);
			totalAmountPrice();
		});

		function totalAmountPrice(){
            var sum = 0;
            $(".buying_price").each(function(){
               var value = $(this).val();
               // console.log($(".buying_price"));
               if(!isNaN(value) && value.length != 0){
                   sum += parseFloat(value);
               }
            });
            // console.log($('.buying_price').length);
            $('#estimated_amount').val(sum);
        }  

	});
</script>
@endsection