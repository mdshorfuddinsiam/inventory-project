<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Dashboard | Upcube - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico">

        {{-- toaster css --}}
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/libs/toastr/build/toastr.min.css"> --}}

        <!-- jquery.vectormap css -->
        <link href="{{ asset('assets') }}/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{ asset('assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets') }}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets') }}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @yield('admin-css')

    </head>

    <body @yield('body-attr')>

        @yield('main-content')

            <!-- JAVASCRIPT -->
            <script src="{{ asset('assets') }}/libs/jquery/jquery.min.js"></script>

           

            <script src="{{ asset('assets') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="{{ asset('assets') }}/libs/metismenu/metisMenu.min.js"></script>
            <script src="{{ asset('assets') }}/libs/simplebar/simplebar.min.js"></script>
            <script src="{{ asset('assets') }}/libs/node-waves/waves.min.js"></script>

            

            <!-- apexcharts -->
            <script src="{{ asset('assets') }}/libs/apexcharts/apexcharts.min.js"></script>

            <!-- jquery.vectormap map -->
            <script src="{{ asset('assets') }}/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="{{ asset('assets') }}/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

            <!-- Required datatable js -->
            <script src="{{ asset('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="{{ asset('assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            
            <!-- Responsive examples -->
            <script src="{{ asset('assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="{{ asset('assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

            <script src="{{ asset('assets') }}/js/pages/dashboard.init.js"></script>

            {{-- <!-- toastr plugin -->
            <script src="{{ asset('assets') }}/libs/toastr/build/toastr.min.js"></script>

            <!-- toastr init -->
            <script src="{{ asset('assets') }}/js/pages/toastr.init.js"></script> --}}

            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

            <script>
                @if(Session::has('message'))
                    var type = "{{ Session::get('alert-type', 'info') }}";
                    switch(type){
                        case 'info':
                            toastr.options =
                              {
                                "closeButton" : true,
                                "progressBar" : true
                              }
                            toastr.info("{{ Session::get('message') }}");
                            break;

                        case 'warning':
                            toastr.options =
                              {
                                "closeButton" : true,
                                "progressBar" : true
                              }
                            toastr.warning("{{ Session::get('message') }}");
                            break;

                        case 'success':
                            toastr.options =
                              {
                                "closeButton" : true,
                                "progressBar" : true
                              }
                            toastr.success("{{ Session::get('message') }}");
                            break;

                        case 'error':
                            toastr.options =
                              {
                                "closeButton" : true,
                                "progressBar" : true
                              }
                            toastr.error("{{ Session::get('message') }}");
                            break;
                    }
                @endif
            </script>

            @yield('admin-js')

             <!-- App js -->
            <script src="{{ asset('assets') }}/js/app.js"></script>

        </body>

    </html>