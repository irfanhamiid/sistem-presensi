<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (Route::currentRouteName() === 'lupa-password')
            Lupa Password
        @elseif (Route::currentRouteName() === 'reset-password')
            Reset Password
        @else
            Login
        @endif
    </title>

    <link rel="icon" href="{{ asset('auth/img/face-id.png') }}" type="image/x-icon" />

    <!-- Fonts -->
    <script src="{{ asset('auth/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["{{ asset('auth/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('auth/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/atlantis.css') }}">

</head>

<body>
    <div id="app">
        <main class="py-4">
            @include('sweetalert::alert')
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <!--   Core JS Files   -->
    <script src="{{ asset('auth/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('auth/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('auth/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('auth/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('auth/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('auth/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


    <!-- Chart JS -->
    <script src="{{ asset('auth/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('auth/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('auth/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('auth/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <!-- <script src="{{ asset('auth/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> -->

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('auth/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('auth/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('auth/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('auth/js/atlantis.min.js') }}"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="{{ asset('auth/js/setting-demo.js') }}"></script>
    <script src="{{ asset('auth/js/demo.js') }}"></script>
    <script type="text/javascript">
        function check() {
            var x = document.getElementById("password");
            var x1 = document.getElementById("password1");


            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            if (x1.type === "password") {
                x1.type = "text";
            } else {
                x1.type = "password";
            }
        }
    </script>
</body>

</html>
