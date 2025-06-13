<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="icon" href ="{{ asset('img/logomounchaat2.JPG') }}" type = "image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    @include('layouts/panels/styles')
</head>

<body>
    <!-- ======= Header ======= -->
    @include('layouts.partials._header')
    <!-- End Header -->
    <!-- ======= Slider Section ======= -->
    @yield('slider-section')
    <!-- End Slider Section -->
    <!-- ======= Main ======= -->
    @yield('main')
    <!-- End Main -->
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    @stack('myModals')
    <!-- ======= Footer ======= -->
    @include('layouts.partials._footer')
    <!-- End Footer -->

    @include('layouts/panels/scripts')

</body>

</html>
