@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل التمويل ') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/or.css') }}" rel="stylesheet">

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
    <!-- main -->
    <div class="container mt-5">
        <div class="card p-4">
            <h3 class="text-center mb-4 title">لتقديم طلب تمويل ابدأ بتعبئة البيانات التالية</h3>
            <form>
                <div class="mb-3">
                    <label for="firstName" class="form-label">الاسم الأول <span
                            class="wpforms-required-label">*</span></label>
                    <input type="text" class="form-control" id="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">الاسم الأخير <span
                            class="wpforms-required-label">*</span></label>
                    <input type="text" class="form-control" id="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="loanType" class="form-label">نوع التمويل <span
                            class="wpforms-required-label">*</span></label>
                    <select class="form-select " id="loanType" required>
                        <option value="تمويل تعليمي">تمويل تعليمي</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="amountRequested" class="form-label">المبلغ المطلوب <span
                            class="wpforms-required-label">*</span></label>
                    <input type="number" class="form-control" id="amountRequested" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">مدة السداد (بالأشهر) <span class="wpforms-required-label">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="loanDuration" id="duration12" value="12"
                            required>
                        <label class="form-check-label" for="duration12">12 شهر</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="loanDuration" id="duration18" value="18">
                        <label class="form-check-label" for="duration18">18 شهر</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="loanDuration" id="duration24" value="24">
                        <label class="form-check-label" for="duration24">24 شهر</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="loanDuration" id="duration60" value="60">
                        <label class="form-check-label" for="duration60">60 شهر</label>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="termsCheck" required>
                    <label class="form-check-label" for="termsCheck">
                        أوافق على جميع البيانات المدخلة صحيحة وأتحمل مسؤوليتها.
                    </label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="termsAgreement" required>
                    <label class="form-check-label" for="termsAgreement">
                        أوافق على الشروط والأحكام الخاصة بطلب التمويل.
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100">إرسال</button>
            </form>
        </div>
    </div>
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
