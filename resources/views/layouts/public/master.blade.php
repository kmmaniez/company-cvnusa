<!--
THEME: Constra - Construction Html5 Template
AUTHOR: Themefisher
-->

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs  -->
    <meta charset="utf-8">
    <title>{{ $title ?? 'Welcome to CV Nusa' }}</title>

    <!-- Mobile Specific Metas -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name=author content="Themefisher">
    <meta name=generator content="Themefisher Constra HTML Template v1.0">

    <!-- Favicon  -->
    <link rel="icon" type="image/png" href="{{ url('assets/images/favicon.png') }}">

    <!-- CSS -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ url('assets/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome/css/all.min.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ url('assets/plugins/animate-css/animate.css') }}">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="{{ url('assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/slick/slick-theme.css') }}">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ url('assets/plugins/colorbox/colorbox.css') }}">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    {{-- @vite('resources/css/app.css') --}}
    @stack('stylesheet')
</head>

<body>
    <div class="body-inner">

        <!-- Header start -->
        <header id="header" class="header-one">
            <!--/ Navigation start -->
            <x-public.navigation></x-public.navigation>
            <!--/ Navigation end -->
        </header>
        <!--/ Header end -->

        @yield('content')
        <!-- Carousel -->

        <!-- Footer -->
        <x-public.footer></x-public.footer>

        @stack('javascript')

    </div><!-- Body inner end -->
</body>
    {{-- @vite('resources/js/app.js') --}}
</html>
