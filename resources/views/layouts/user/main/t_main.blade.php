<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    @yield('title')

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/main/dist/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/main/dist/assets/modules/fontawesome/css/all.min.css') }}">

    {{-- data table --}}
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('template/main/dist/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/main/dist/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/main/dist/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/main/dist/assets/modules/summernote/summernote-bs4.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template/main/dist/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/main/dist/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @yield('navbar')
            @yield('sidebar')

            <!-- Main Content -->
            @yield('content')
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div><a
                        href="https://nauval.in/">Kejaksaan Tinggi Jawa Tengah</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('template/main/dist/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('template/main/dist/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('template/main/dist/assets/js/page/index-0.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('template/main/dist/assets/modules/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('template/main/dist/assets/js/page/modules-sweetalert.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('template/main/dist/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('template/main/dist/assets/js/custom.js') }}"></script>
    <script src="https://kit.fontawesome.com/142d239858.js" crossorigin="anonymous"></script>

    {{-- data table --}}
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>


</body>

</html>
@yield('sweet_alert')

@if (session('failed'))
    <script>
        $(document).ready(function() {
            var errorMessage = "{{ session('failed') }}";
            swal('Gagal', errorMessage, 'error');

        });
    </script>
@elseif (session('success'))
    <script>
        $(document).ready(function() {
            var successMessage = "{{ session('success') }}";
            swal('Berhasil', successMessage, 'success');
        });
    </script>
@endif
