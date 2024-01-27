@extends('admin.admin_master')
@section('content')

<section class="content">
	<div class="row">
	  <div class="col-md-6">
		<div class="box bt-3 border-info">
		  <div class="box-header">
			{{-- <h4 class="box-title">Bordery <strong>Top</strong></h4> --}}
			<br>
			<center>
			      <img class="img-thumbnail rounded-circle avatar-xl"  src="{{ @$profileData->profile_image == null ? asset('upload/no_image.jpg') : asset($profileData->profile_image) }}" alt="Card image cap">
			</center>
			<br>
			<br>
		  </div>

		  <div class="box-body">
			<h4 class="box-title">Name : {{ @$profileData->name }}</h4>
            <hr>
            <h4 class="box-title">Email : {{ @$profileData->email }}</h4>
            <hr>
            <h4 class="box-title">Name : {{ @$profileData->username }}</h4>
            <hr>
            <br>
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-info btn-rounded waves-effect waves-light float-end">Edit Profile</a>
		  </div>
		</div>
	  </div>
	</div>
</section>

@endsection