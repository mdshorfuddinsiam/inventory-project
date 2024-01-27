@extends('admin.admin_master')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Form Validation</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Forms</li>
                        <li class="breadcrumb-item active" aria-current="page">Form Validation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">

 <!-- Basic Forms -->
  <div class="box">
    <div class="box-header with-border">
      <h4 class="box-title">Home Slider Edit</h4>
      {{-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> --}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col">
            {{-- <form novalidate> --}}
            <form action="{{ route('home.slider.update', $homeSlider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="row">
                <div class="col-12">                        
                    <div class="form-group">
                        <h5>Title <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="title" class="form-control" id="title" value="{{ @$homeSlider->title }}" placeholder="Title" required data-validation-required-message="This field is required">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Short Title <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="short_title" class="form-control" id="short_title" value="{{ @$homeSlider->short_title }}" placeholder="Short Title" required data-validation-required-message="This field is required">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Video Url <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="url" name="video_url" class="form-control" id="video_url" value="{{ @$homeSlider->video_url }}" placeholder="Video Url" required data-validation-required-message="This field is required">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Slider Image <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="file" name="image" class="form-control" id="image" > 
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Slider Image <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <img id="slide_image" class="rounded avatar-lg" src="{{ $homeSlider->image == null ? asset('upload/no_image.jpg') : asset($homeSlider->image) }}" alt="Slider Image"> 
                        </div>
                    </div>
                </div>
              </div>
                <div class="text-xs-right">
                    <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                </div>
            </form>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

@endsection


@section('admin-js')
<script type="text/javascript">   
      $(document).ready(function (e) {
         $('#image').change(function(){            
          let reader = new FileReader();
          reader.onload = (e) => { 
            $('#slide_image').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]); 
         });
      });
</script>
@endsection