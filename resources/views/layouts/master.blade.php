<!DOCTYPE html>
<html lang="en">

<head>
    {{--  <!-- Required meta tags-->  --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    {{--  <!-- Title Page-->  --}}
    <title>@yield('title')</title>

    {{--  <!-- Fontfaces CSS-->  --}}
    <link href="{{ asset('Admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    {{--  <!-- Bootstrap CSS-->  --}}
    <link href="{{ asset('Admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{--  <!-- Vendor CSS-->  --}}
    <link href="{{ asset('Admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('Admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    {{--  <!-- Main CSS-->  --}}
    <link href="{{ asset('Admin/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('Admin/images/icon/logo.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{--  <!-- Jquery JS-->  --}}
    <script src="{{ asset('Admin/vendor/jquery-3.2.1.min.js') }}"></script>
    {{--  <!-- Bootstrap JS-->  --}}
    <script src="{{ asset('Admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    {{--  <!-- Vendor JS -->  --}}
    <script src="{{ asset('Admin/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('Admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('Admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('Admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('Admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('Admin/vendor/select2/select2.min.js') }}">
    </script>

    {{--  <!-- Main JS-->  --}}
    <script src="{{ asset('Admin/js/main.js') }}"></script>

</body>

</html>
<!-- end document-->
