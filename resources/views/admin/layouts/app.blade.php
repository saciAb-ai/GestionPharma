<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ucfirst('PharmacyMS')}} - {{ucfirst($title ?? '')}}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/pharmacy_logo.jpg')}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/icons.min.css')}}">
    <!-- Snackbar CSS -->

    <!-- Sweet Alert css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">

    <!-- Select2 Css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    
    <!-- Custom Theme Overrides -->
    <style>
        :root {
            --primary: #10B981;
            --primary-dark: #059669;
            --secondary: #34D399;
            --dark: #1F2937;
            --light: #F9FAFB;
        }
        body {
            font-family: 'Outfit', sans-serif !important;
            background-color: var(--light) !important;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif !important;
        }
        .header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary)) !important; 
            border: none !important;
        }
        .sidebar {
            background-color: #fff !important;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .sidebar-menu li a {
            color: var(--dark) !important;
        }
        .sidebar-menu li.active a {
            color: var(--primary) !important;
            background-color: rgba(16, 185, 129, 0.1) !important;
        }
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
        }
        .page-header .page-title {
            color: var(--dark) !important;
        }
        
        /* Sidebar Hover & Active States */
        .sidebar-menu li a:hover {
            color: var(--primary) !important;
            background-color: rgba(16, 185, 129, 0.1);
        }
        .sidebar-menu li.active a {
            color: var(--primary) !important;
            background-color: rgba(16, 185, 129, 0.2) !important;
            border-left: 3px solid var(--primary);
        }
        
        /* Menu Title Text Black */
        .sidebar-menu .menu-title span {
            color: #000000 !important;
            font-weight: 700;
        }
        
        /* Disable Logo Click */
        .header-left .logo, .header-left .logo-small {
            pointer-events: none;
            cursor: default;
        }

        /* User Menu Dropdown Hover */
        .user-menu .dropdown-menu .dropdown-item:hover,
        .user-menu .dropdown-menu .dropdown-item:focus {
            background-color: var(--primary) !important;
            color: #fff !important;
        }

        /* Override btn-success for Add Buttons (Add Product, Add User, etc) */
        .btn-success {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
        }
        .btn-success:hover, .btn-success:focus, .btn-success:active {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }
    </style>

    <!-- Page CSS -->
    @stack('page-css')
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('admin.includes.header')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('admin.includes.sidebar')
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        @stack('page-header')
                    </div>
                </div>
                <!-- /Page Header -->
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alerts.danger :error="$error" />
                    @endforeach
                @endif

                @yield('content')
                <!-- add sales modal-->
                <x-modals.add-sale />
                 <!-- / add sales modal -->
            </div>
            @include('admin.includes.footer')
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->
    
</body>
<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- Sweet Alert Js -->
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('assets/js/script.js')}}"></script>
<script>
    $(document).ready(function(){
        $('body').on('click','#deletebtn',function(){
            var id = $(this).data('id');
            var route = $(this).data('route');
            swal.queue([
                {
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: '<i class="fe fe-trash mr-1"></i> Delete!',
                    cancelButtonText: '<i class="fa fa-times mr-1"></i> Cancel!',
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ml-2 mt-2",
                    buttonsStyling: !1,
                    preConfirm: function(){
                        return new Promise(function(){
                            $.ajax({
                                url: route,
                                type: "DELETE",
                                data: {"id": id},
                                success: function(){
                                    swal.insertQueueStep(
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Resource has been deleted.",
                                            type: "success",
                                            showConfirmButton: !1,
                                            timer: 1500,
                                        })
                                    )
                                    $('.datatable').DataTable().ajax.reload();
                                }
                            })

                        })
                    }
                }
            ]).catch(swal.noop);
        }); 
    });

</script>
<!-- Page JS -->
@stack('page-js')
</html>