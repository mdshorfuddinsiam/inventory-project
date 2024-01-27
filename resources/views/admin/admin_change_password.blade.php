@extends('admin.admin_master')
@section('content')

<div class="page-content">
	<div class="container-fluid">

		<div class="row mt-20">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Admin Change Password</h4>
                        <br>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
        	                        <i class="mdi mdi-block-helper me-2"></i>
        	                        {{ $error }}
        	                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        	                    </div>
                            @endforeach
                        @endif
                        <br>
                        <form action="{{ route('admin.update.password') }}" method="POST" >
                        	@csrf

                        	<div class="row mb-3">
                        	    <label for="oldpassword" class="col-sm-2 col-form-label">Old Password</label>
                        	    <div class="col-sm-10">
                        	        <input class="form-control" type="password" name="oldpassword" placeholder="Name" id="oldpassword">
                        	    </div>
                        	</div>
                        	<!-- end row -->

                        	<div class="row mb-3">
                        	    <label for="password" class="col-sm-2 col-form-label">New Password</label>
                        	    <div class="col-sm-10">
                        	        <input class="form-control" type="password" name="password"  placeholder="password" id="password">
                        	    </div>
                        	</div>
                        	<!-- end row -->

                        	<div class="row mb-3">
                        	    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                        	    <div class="col-sm-10">
                        	        <input class="form-control" type="password" name="password_confirmation" placeholder="password_confirmation" id="password_confirmation">
                        	    </div>
                        	</div>
                        	<!-- end row -->

                        	

                        	<div class="row mb-3">
                        	    <label for="profile_image" class="col-sm-2 col-form-label"></label>
                        	    <div class="col-sm-10">
                        	        <input class="btn btn-info btn-rounded waves-effect waves-light float-end" type="submit" value="Upadate Password">
                        	    </div>
                        	</div>
                        	<!-- end row -->
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

	</div>
</div>

@endsection