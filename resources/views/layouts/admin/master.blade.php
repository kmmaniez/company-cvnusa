<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="{{ env('APP_AUTHOR') }}">
    <meta name="crsf" content="{{ csrf_token() }}">

    <title>{{ $title ? 'Halaman '. $title . ' Admin' : env('APP_NAME') }}</title>

    <!-- Custom fonts -->
    <link href="{{ url('sb-admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ url('sb-admin') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Trix Editor -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/trix/trix.css') }}">
    <script type="text/javascript" src="{{ asset('assets/trix/trix.js') }}"></script>

    @stack('assets')

<style>
        input.form-control:focus, textarea.form-control:focus{
            box-shadow: none;
            border: 1px solid rgba(0, 0, 255, 0.448);
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <x-admin.sidebar></x-admin.sidebar>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Navigation -->
                <x-admin.navbar></x-admin.navbar>

                <!-- Content -->
                <div class="container-fluid">
                    @yield('konten')
                </div>

            </div>

            <!-- Footer -->
            <x-admin.footer></x-admin.footer>

        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('sb-admin') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('sb-admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('sb-admin') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('sb-admin') }}/js/sb-admin-2.min.js"></script>

    <!-- Vendor scripts -->
    <script src="{{ asset('assets/sweetalert/dist/sweetalert2.all.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
