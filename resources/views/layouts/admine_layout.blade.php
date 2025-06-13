<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href ="{{ asset('img/logomounchaat2.JPG') }}" type = "image/x-icon">

    <title> Dashboard</title>


    @include('layouts/admin/styles')
</head>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open  layout-navbar-fixed " >
    <div class="wrapper">
    <!-- ======= Header ======= -->
    @include('layouts.admin._header')
    <!-- End Header -->

    <!-- ======= SideBar ======= -->
    @include('layouts.admin._sidebar')
    <!-- End SideBar -->



    <!-- ======= Main ======= -->
    @yield('main')
    <!-- End Main -->

    @stack('myModals')
    <!-- ======= Footer ======= -->
    {{-- @include('layouts.admin._footer') --}}
    <!-- End Footer -->

    @include('layouts/admin/scripts')
    
</div>
</body>

</html>
