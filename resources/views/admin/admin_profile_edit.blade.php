@extends('admin.admin_master')
@section('content')

<!-- Main content -->
<section class="content">

  <div class="row">

  <div class="col-12">
    <div class="box">
      
      <div class="box-header">
        <h4 class="box-title">Admin Profile Edit</h4>  
      </div>
      <div class="box-body">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group row">
            <label class="col-form-label col-md-2">Name</label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="name" value="{{ @$profileData->name }}" placeholder="Name" id="name">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Email</label>
            <div class="col-md-10">
              <input class="form-control" type="email" name="email" value="{{ @$profileData->email }}" placeholder="Email" id="email">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Username</label>
            <div class="col-md-10">
              <input class="form-control" type="text" name="username" value="{{ @$profileData->username }}" placeholder="Username" id="username">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-lg-2">Profile Image</label>
            <div class="col-lg-10">
              <input type="file" class="form-control" name="profile_image" placeholder="profile_image" id="profile_image">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-lg-2">   </label>
            <div class="col-lg-10">
              <img id="image" class="rounded avatar-lg" src="{{ @$profileData->profile_image == null ? asset('upload/no_image.jpg') : asset(@$profileData->profile_image) }}" alt="Profile Image">
            </div>
          </div>

          <div class="text-xs-right">
              {{-- <button type="submit" class="btn btn-rounded btn-info">Update Profile</button> --}}
              <button type="submit" class="btn btn-rounded btn-info mb-5">Update Profile</button>
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
<script type="text/javascript">   
      $(document).ready(function (e) {
         $('#profile_image').change(function(){            
          let reader = new FileReader();
          reader.onload = (e) => { 
            $('#image').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
         });
      });
</script>
@endsection