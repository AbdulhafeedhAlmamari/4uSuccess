<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @auth
        <meta name="user-id" content="{{ Auth::id() }}">
    @endauth

    <!-- Pusher credentials -->
    <meta name="pusher-app-key" content="{{ config('broadcasting.connections.pusher.key') }}">
    <meta name="pusher-app-cluster" content="{{ config('broadcasting.connections.pusher.options.cluster') }}">

    <title>@yield('title', config('app.name'))</title>

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
{{-- AOS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>


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
