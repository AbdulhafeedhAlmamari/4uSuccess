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

    <style>
        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
            position: relative;
        }

        .upload-area:hover {
            border-color: #6c5b9e;
        }

        .upload-icon {
            font-size: 24px;
            color: #6c5b9e;
            margin-bottom: 10px;
        }

        .upload-text {
            color: #777;
            font-size: 14px;
        }

        .submit-btn {
            background-color: #6c5b9e;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            color: white;
            font-weight: 600;
            width: 200px;
            margin: 0 auto;
            display: block;
        }

        .submit-btn:hover {
            background-color: #5a4a85;
        }

        .submit-btn i {
            margin-left: 8px;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 10px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
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
