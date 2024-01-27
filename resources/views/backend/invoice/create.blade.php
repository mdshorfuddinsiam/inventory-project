@extends('admin.admin_master')
@section('title')
	Create Invoice
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
			<h4 class="box-title">Create Invoice</h4>  
		</div>
		<div class="box-body">
			
			<div class="row">
				<div class="col-md-1">
					<div class="form-group">
						<h5>Invoic No <span class="text-danger"></span></h5>
						<div class="controls">
							<input type="text" name="invoice_no" class="form-control" id="invoice_no" value="{{ $invoice_no }}" readonly style="background-color: #ddd"> 
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<h5>Date <span class="text-danger">*</span></h5>
						<div class="controls">
							<input type="date" name="date" class="form-control" id="date" value="{{ $date }}" required>
						</div>

					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<h5>Category Name <span class="text-danger">*</span></h5>
						<div class="controls">
							<select name="category_id" id="category_id" required="" class="form-control select2" style="width: 100%;" aria-invalid="false">
								<option value="" selected disabled hidden="">Select One</option>
								@foreach($categories as $row)
								<option value="{{ $row->id }}">{{ $row->name }}</option>
								@endforeach
							</select>
					    </div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<h5>Product Name <span class="text-danger">*</span></h5>
						<div class="controls">
							<select name="product_id" id="product_id" required="" class="form-control select2" style="width: 100%;" aria-invalid="false">
								<option value="" selected disabled hidden="">Select One</option>

							    
							</select>
					    </div>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<h5>Stock(Pcs/Kg) <span class="text-danger"></span></h5>
						<div class="controls">
							<input type="text" name="current_stock_quantity" class="form-control" id="current_stock_quantity" readonly style="background-color: #ddd"> 
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
			<form action="{{ route('invoices.store') }}" method="POST">
				@csrf

				<table class="table table-bordered text-center" width="100%" {{-- style="border: 2px solid white" --}}>
					<thead>
						<tr>
							<th>Category</th>
							<th>Product Name</th>
							<th width="10%">PCS/KG</th>
							<th width="10%">Unit Price</th>
							<th width="12%">Total Price</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody id="addRow" class="addRow">
						
					</tbody>
					<tbody>
						<tr id="addDiscountRow" {{-- class="d-none" --}}>
							<td colspan="4" class="text-right">Discount</td>
							<td >
								<input type="text" name="discount_amount" id="discount_amount" class="form-control" value="0" placeholder="Discount Amount">
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4" class="text-right">Grand Total</td>
							<td >
								<input type="text" name="estimated_amount" id="estimated_amount" class="form-control" value="0" readonly style="background-color: #ddd">
							</td>
							<td></td>
						</tr>
					</tbody>
				</table>

				{{-- Description --}}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<h5>Description <span class="text-danger"></span></h5>
							<div class="controls">
								<textarea name="description" id="description" cols="165" rows="5" placeholder="Write Description Here"></textarea>
							</div>
						</div>
					</div>
				</div>

				{{-- Paid Status And Customers --}}
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<h5>Paid Status <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="paid_status" id="paid_status" {{-- required="" --}} class="form-control select2" style="width: 100%;" aria-invalid="false">
									<option value="" selected disabled hidden="">Select One</option>
									<option value="full_paid">Full Paid</option>
									<option value="full_due">Full Due</option>
									<option value="partial_paid">Partial Paid</option>
								</select>
								@error('paid_status')
									<span class="text-danger">{{ $message }}</span>
								@enderror
								<input type="text" class="form-control d-none paid_amount" name="paid_amount" id="paid_amount" placeholder="Enter Paid Amount">
								@error('paid_amount')
									<span class="text-danger">{{ $message }}</span>
								@enderror
						    </div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<h5>Customer Name <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="customer_id" id="customer_id" {{-- required="" --}} class="form-control select2" style="width: 100%;" aria-invalid="false">
									<option value="" selected disabled hidden="">Select One</option>
									@foreach($customers as $row)
									<option value="{{ $row->id }}">{{ $row->name }}</option>
									@endforeach
									<option value="0">New Customer</option>
								</select>
								@error('customer_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
						    </div>
						</div>
					</div>
				</div>

				{{-- Add new Customer --}}
				<div class="row new_customer" style="display: none;">
					<div class="col-md-4">
						<div class="form-group">
							<h5> <span class="text-danger"></span></h5>
							<div class="controls">
								<input type="text" name="name" class="form-control" id="name" placeholder="Write Customer Name"> 
								@error('name')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<h5> <span class="text-danger"></span></h5>
							<div class="controls">
								<input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Write Customer Phone">
								@error('mobile_no')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<h5> <span class="text-danger"></span></h5>
							<div class="controls">
								<input type="email" name="email" class="form-control" id="email" placeholder="Write Customer Email"> 
								@error('email')
									<span class="text-danger">{{ $message }}</span>
								@enderror 
							</div>
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-info mt-10" id="storeBtn">Invoice Store</button>

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
<script id="document-template" type="text/x-handlebars-template">
  <tr id="delete_add_more_item" class="delete_add_more_item">
  		<input type="hidden" name="date" value="@{{date}}">
  		<input type="hidden" name="invoice_no" value="@{{invoice_no}}">
  	<td>
  		<input type="hidden" name="category_id[]" value="@{{category_id}}">
  		@{{category_name}}
  	</td>
  	<td>
  		<input type="hidden" name="product_id[]" value="@{{product_id}}">
  		@{{product_name}}
  	</td>
  	<td>
  		<input type="number" class="form-control selling_qty" name="selling_qty[]" min="1" value="1" required>
  	</td>
  	<td>
  		<input type="number" class="form-control unit_price" name="unit_price[]" min="0" value="0" required>
  	</td>
  	<td>
  		<input type="number" class="form-control selling_price" name="selling_price[]" value="0" readonly>
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
			var invoice_no = $('#invoice_no').val();
			var category_id = $('#category_id').val();
			var category_name = $('#category_id').find('option:selected').text();
			var product_id = $('#product_id').val();
			var product_name = $('#product_id').find('option:selected').text();

			// alert(product_id);

			if(date == ''){
				$.notify("Date is required", {globalPosition: 'top-right', className: 'error'});
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
				invoice_no:invoice_no,
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
			//   		<input type="number" class="form-control selling_qty" name="selling_qty[]"  min="1">\
			//   	</td>\
			//   	<td>\
			//   		<input type="number" class="form-control unit_price" name="unit_price[]" >\
			//   	</td>\
			//   	<td>\
			//   		<input type="text" class="form-control description" name="description[]" >\
			//   	</td>\
			//   	<td>\
			//   		<input type="number" class="form-control selling_price" name="selling_price[]"\ value="0" readonly>\
			//   	</td>\
			//   	<td>\
			//   		<i class="btn btn-danger fa fa-window-close removeeventmore" aria-hidden="true"></i>\
			//   	</td>\
			//   </tr>');
		});

		$(document).on('click', '.removeeventmore', function(){
			$(this).closest('.delete_add_more_item').remove();
			totalAmountPrice();
			// $('#discount_amount').trigger('keyup');
		});

		$(document).on('click keyup', '.selling_qty, .unit_price', function(){
			var selling_qty = $(this).closest('tr').find('input.selling_qty').val();
			var unit_price = $(this).closest('tr').find('input.unit_price').val();
			var selling_price = selling_qty * unit_price;
			$(this).closest('tr').find('input.selling_price').val(selling_price);
			// totalAmountPrice();
			$('#discount_amount').trigger('keyup');

			// $('#addDiscountRow').removeClass('d-none');
		});

		$(document).on('keyup', '#discount_amount', function(){
			totalAmountPrice();
		});

		function totalAmountPrice(){
            var sum = 0;
            $(".selling_price").each(function(){
               var value = $(this).val();
               // console.log($(".selling_price"));
               if(!isNaN(value) && value.length != 0){
                   sum += parseFloat(value);
               }
            });
            // $('#estimated_amount').val(sum);

        	var discount_amount = $('#discount_amount').val();
        	if(!isNaN(discount_amount) && discount_amount.length != 0){
        		sum -= parseFloat(discount_amount);
        	}
        	$('#estimated_amount').val(sum);
        }  

		// function totalAmountPrice(){
  //           var sum = 0;
  //           $(".selling_price").each(function(){
  //              var value = $(this).val();
  //              // console.log($(".selling_price"));
  //              if(!isNaN(value) && value.length != 0){
  //                  sum += parseFloat(value);
  //              }
  //           });
  //           // $('#estimated_amount').val(sum);

  //           if(sum == 0){
  //           	$('#estimated_amount').val(sum);  
  //           	$('#addDiscountRow').addClass('d-none');
  //           }else{
  //           	var discount_amount = $('#discount_amount').val();
  //           	if(!isNaN(discount_amount) && discount_amount.length != 0){
  //           		sum -= parseFloat(discount_amount);
  //           	}
  //           	$('#estimated_amount').val(sum);
  //           }
  //       }  

	});
</script>
<script>
	$(document).on('change', '#paid_status', function(){
		var paid_status = $(this).val();
		if(paid_status == 'partial_paid'){
			$('#paid_amount').removeClass('d-none');
		}else{
			$('#paid_amount').addClass('d-none');
		}
	});
</script>
<script>
	$(document).on('change', '#customer_id', function(){
		var customer_id = $(this).val();
		if(customer_id == '0'){
			$('.new_customer').show();
		}else{
			$('.new_customer').hide();
		}
	});
</script>
@endsection