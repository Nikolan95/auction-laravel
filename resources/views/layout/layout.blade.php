<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Auction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- DataTables -->
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}"  rel="stylesheet">
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}"  rel="stylesheet" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('plugins/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert -->
    <link href="{{asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">

    <!-- App css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>


    <!-- leftbar-tab-menu -->
    @include('layout.leftbar')
    <!-- Top Bar Start -->
    @include('layout.topbar')
    <!-- Top Bar End -->

    <div class="page-wrapper">
        <!-- Page Content-->
        @yield('content')
        <!-- end page content -->
    </div>
</body>




<!-- jQuery  -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/metismenu.min.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/feather.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('plugins/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Sweet-Alert  -->
<script src="{{asset('plugins/sweetalert/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/jquery.sweet-alert.init.js')}}"></script>

<script src="{{asset('plugins/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('pages/jquery.form-upload.init.js')}}"></script>

<!-- App js -->
<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $('#datatable').DataTable();
</script>

</body>

</html>
