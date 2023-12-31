<!DOCTYPE html>
<html lang="zxx">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Title -->
        <title> @yield('title')</title>

        <!-- Bootstrap css -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <!-- animate css -->
        <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}" />
        <!-- Fontawesome css -->
        <link rel="stylesheet" href="{{ asset('css/fontawesome.all.min.css') }}" />
        <script src="https://kit.fontawesome.com/6951010ac6.js" crossorigin="anonymous"></script>
        <!-- owl.carousel css -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
        <!-- owl.theme.default css -->
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" />
        <!-- datatable min.css -->
        <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/datatables-select.min.css') }}" />

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css" />


        <!-- navbar css  -->
        <link rel="stylesheet" href="{{ asset('css/search.css') }}" />
        <!-- navbar css  -->
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
        <!-- image gallery -->
        <link rel="stylesheet" href="{{ asset('css/simple-lightbox.min.css') }}" />

        <!-- Responsive css -->
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
        <!-- Favicon -->
        <link rel="stylesheet" href="{{ asset('css/favicon.png') }}" />

        <!-- Style css -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />


        <!-- Toggle dropdown profile css -->
        <link rel="stylesheet" href="{{ asset('css/toggle_dropdown_profile.css') }}" />

        <!-- password hidden and show eay button -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        <!-- student css -->
        <link rel="stylesheet" href="{{ asset('css/student.css') }}" />

        <style>
            .swalstyle {
                width: 300px !important;
                height: 220px !important;
                font-size: 10px !important;
            }
        </style>

    </head>

    <body>



        @include('layouts.menue')

        @yield('content')

        @include('layouts.footer')






        <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('summary-ckeditor');
        </script>

        <!-- font awesome kit -->
        <script src="https://kit.fontawesome.com/6951010ac6.js" crossorigin="anonymous"></script>

        <!-- jquery  -->
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <!-- Bootstrap js -->
        <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
        <!-- owl carousel js -->
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <!-- wow.js -->
        <script src="{{ asset('js/wow.min.js') }}"></script>
        <!-- datatables -->
        <script src="{{ asset('js/datatables-select.min.js') }}"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <!-- sweet alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- axios -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <!-- jqeury gallery -->
        <script src="{{ asset('js/simple-lightbox.min.js') }}"></script>
        <script src="{{ asset('js/simple-lightbox.legacy.min.js') }}"></script>
        <script src="{{ asset('js/simple-lightbox.jquery.min.js') }}"></script>

        <!-- jquery tost -->
        <script src="{{ asset('js/notifications.js') }}"></script>

        <!-- Custom js -->
        <script src="{{ asset('js/custom.js') }}"></script>

        <!-- Student Custom js -->
        <script src="{{ asset('js/student_custom.js') }}"></script>

        <!-- toggle dropdown profile js -->
        <script src="{{ asset('js/toggle_dropdown_profile.js') }}"></script>


    </body>

</html>
