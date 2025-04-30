@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل التمويل ') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/house.css') }}" rel="stylesheet">

    <style>
        .login-title {
            font-family: Almarai;
            font-size: 40px;
            font-weight: 400;
            line-height: 56px;
            text-align: center;
        }

        .last-radio {
            width: 100%;
            text-align-last: center;
        }

        .last-radio input {
            float: none !important;
            position: relative;
            right: 70px;
        }

        .btn-login {
            background: linear-gradient(90deg, #5F5F91 0%, #54B6B7 100%);
            border: 0;
            width: 100%;
            color: white;
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
            height: 40px;
        }

        .btn-login:hover {
            color: white;
        }

        .register-link {
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: center;
            color: #1E1E1E;
            text-decoration: none;
            width: 100%;
            float: inline-end;
        }

        .form-label {
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: right;
        }

        .form-check-input {
            font-family: Almarai;
            font-size: 15px;
            font-weight: 400;
            line-height: 22px;
        }

        .login-bg {
            background-image: url('img/login-bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-blend-mode: multiply;
            background-color: #6d5ba7;
            border-radius: 10px;
        }

        .login-sidetitle {
            font-family: Almarai;
            font-size: 32px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: center;
            color: white;
            margin-top: 160px !important;
        }

        .login-subtitle {
            font-family: Almarai;
            font-size: 32px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: center;
            color: white;
        }

        .btn-joing {
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
            text-align: center;
            color: #61528B;
            background-color: #fff;
            width: 292px;
            height: 40px;
            padding: 12px;
            border-radius: 8px;
            position: relative;
            right: 110px;
            top: 10px;
        }

        .btn-joing:hover {
            color: #61528B;
            background-color: #fff;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 100%;
                margin: 1.75rem auto;
            }
        }

        .modal-dialog {
            width: 70%;
            margin: 1.75rem auto;
        }

        .finance-btn {
            background-color: #61528B;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .finance-btn:hover {
            background-color: #54B6B7;
            border-color: #61528B;
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            /* ظل أقوى */
            /* تكبير الزر قليلاً */
        }

        .finance-btn:active {
            transform: scale(0.95);
            /* يصغر الزر عند الضغط */
            background-color: #3a2a6c;
            /* لون مختلف عند الضغط */
        }
    </style>
@endsection
@section('content')

<br><br><br><br><br>
    <div class="container my-5">
        <div class="row align-items-center text-center">
            <div class="col-md-4 text-center">
                <img src="{{ asset($financingCompany->user->profile_image ?? 'build/assets/images/cons-1.jpg') }}"
                    alt="إمكان" class="img-fluid" style="max-width: 320px;">
            </div>
            <div class="col-md-5 text-start">
                <h4>{{ $financingCompany->user->name }}</h4>
                <p>{{ $financingCompany->phone_number }}</p>
                <p>{{ $financingCompany->address }}</p>
                <p>
                    {{ $financingCompany->description }}
                </p>
            </div>
            <div class="col-md-3 text-center">
                <a href="{{ route('home.finances.order.create', $financingCompany->id) }}" class="finance-btn">طلب تمويل</a>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
@endsection

@section('script')
    <script>
        function changeMainImage(imageElement) {
            // Get the main image element
            const mainImage = document.getElementById('mainImage');
            // Set its src to the clicked sub-image's src
            mainImage.src = imageElement.src;
        }
    </script>
@endsection
