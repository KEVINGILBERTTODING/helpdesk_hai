<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        @yield('title')
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('template/landing_page/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('template/landing_page/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('template/landing_page/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('template/landing_page/css/style.css') }}" rel="stylesheet">
        <style>
            *{
                padding: 5px;
            }
            .divider:after,
            .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
            }
        </style>
    </head>

    <body>
        @yield('content')


        <!-- JavaScript Libraries -->
        <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js') }}"></script>
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template/landing_page/lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('template/landing_page/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('template/landing_page/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('template/landing_page/lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('template/landing_page/js/main.js') }}"></script>
    </body>

</html>
