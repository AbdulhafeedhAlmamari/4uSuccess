<!doctype html>
<html lang="ar" dir="rtl" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    {{-- token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @include('layouts.head-css')
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        {{-- @include('layouts.sidebar') --}}
        {{-- main content --}}
        <div class="main-content">
            <div class="page-content">
                @yield('content')


                <!-- login modal -->
                <x-login-modal />

                <!-- register modal -->
                <x-register-modal />
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    {{-- @include('layouts.customizer') --}}

    <!-- JAVASCRIPT -->
    @include('layouts.footer-scripts')
    {{-- <script>    toastr.success('ssssssssssss', 'نجاح');
</script> --}}

    {{-- success alert --}}
    @include('alerts.alert')

</body>

</html>
