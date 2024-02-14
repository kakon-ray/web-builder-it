<!DOCTYPE html>
<html lang="zxx">

    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Title -->
        <title> @yield('title')</title>

        <!-- Bootstrap css -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <!-- datatable min.css -->
        <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/datatables-select.min.css') }}" />


        {{-- admin panel style --}}

        <!-- Custom fonts for this template-->
        <link href="{{ asset('adminpanel/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <!-- Style css -->
        <link href="{{ asset('adminpanel/css/sb-admin-2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('adminpanel/css/sb-admin-2.css') }}" rel="stylesheet">


        <style>
            .swalstyle {
                width: 300px !important;
                font-size: 10px !important;
            }


        </style>
    </head>

    <body>



        @include('layouts.admin_menue')

        @yield('content')

        @include('layouts.admin_footer')




        <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('summary-ckeditor');
        </script>

        {{-- admin dashboarad jquery link start --}}
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('adminpanel/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminpanel/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('adminpanel/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('adminpanel/js/sb-admin-2.min.js') }}"></script>
        <!-- Page level plugins -->
        <script src="{{ asset('adminpanel/vendor/chart.js/Chart.min.js') }}"></script>
        <!-- Page level custom scripts -->
        <script src="{{ asset('adminpanel/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('adminpanel/js/demo/chart-pie-demo.js') }}"></script>

        {{-- admin dashboarad jquery link end --}}


        <!-- datatables -->
        <script src="{{ asset('js/datatables-select.min.js') }}"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>

        <!-- sweet alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- axios -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <!-- Custom js -->
        <script src="{{ asset('js/custom.js') }}"></script>


        <!-- toggle dropdown profile js -->
        <script src="{{ asset('js/toggle_dropdown_profile.js') }}"></script>

        <!-- jquery tost -->

        <script src="{{ asset('js/notifications.js') }}"></script>

        <script>
            var desc;
            ClassicEditor
                .create(document.querySelector('#add_course_editor'), {
                    ckfinder: {
                        uploadUrl: '{{ route('admin.image.upload') . '?_token=' . csrf_token() }}',
                    }
                })
                .then(editor => {
                    console.log(editor)
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    </body>

</html>
