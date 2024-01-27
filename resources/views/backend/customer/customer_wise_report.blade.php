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
						<input name="customer_wise_report" type="radio" id="customer_wise_credit" value="customer_wise_credit" class="search_value">
						<label for="customer_wise_credit">Customer Wise Credit Report</label>

						<input name="customer_wise_report" type="radio" id="customer_wise_paid" value="customer_wise_paid" class="search_value">
						<label for="customer_wise_paid">Customer Wise Paid Report</label>							
					</fieldset>
				</div>
			</div>
		  </div>

		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			  {{-- Customer Wise Credit Report Form --}}
			  <form id="showCreditForm" action="{{ route('customer.wise.credit.pdf') }}" target="_blank" method="GET" style="display: none;">

				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<h5>Customer Name <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="customer_id" class="form-control select2" style="width: 100%;">
								  <option selected="selected" disabled hidden="">Select One</option>
								  @foreach($customers as $row)
								  <option value="{{ $row->id }}">{{ $row->name }}</option>
								  @endforeach
								</select>
								@error('customer_id')
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

			    {{-- Customer Wise Paid Report Form --}}
			    <form id="showPaidForm" action="{{ route('customer.wise.paid.pdf') }}" target="_blank" method="GET" style="display: none;">

					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<h5>Customer Name <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="customer_id" class="form-control select2" style="width: 100%;">
									  <option selected="selected" disabled hidden="">Select One</option>
									  @foreach($customers as $row)
									  <option value="{{ $row->id }}">{{ $row->name }}</option>
									  @endforeach
									</select>
									@error('customer_id')
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
	$(document).on('change', '[name="customer_wise_report"]', function(){
		var value = $(this).val();
		if(value == 'customer_wise_credit'){
			$('#showCreditForm').show();
		}else{
			$('#showCreditForm').hide();
		}
	});
</script>
<script>
	$(document).on('change', '[name="customer_wise_report"]', function(){
		var value = $(this).val();
		if(value == 'customer_wise_paid'){
			$('#showPaidForm').show();
		}else{
			$('#showPaidForm').hide();
		}
	});
</script>
@endsection