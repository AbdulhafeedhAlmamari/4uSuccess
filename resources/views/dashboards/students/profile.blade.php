@extends('layouts.app')
@section('title')
    {{ __('الملف الشخصي') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/profile.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- profile section -->
    <div class="container mt-5">
        <div class="card p-4">
            <h4 class="mb-4">تفاصيل الملف الشخصي</h4>
            <div class="row align-items-center mb-3">
                <div class="col-auto">
                    <div class="profile-img">
                        <img src="{{ asset('build/assets/images/cons-1.jpg') }}" alt="صورة الملف الشخصي">
                    </div>
                </div>
                <div class="col mt-4">
                    <button class="btn btn-primary">تحميل صورة جديدة</button>
                    <button class="btn btn-secondary">إعادة ضبط</button>
                    <p class="text-muted small mt-1">مسموح ب JPG أو GIF أو PNG. الحد الأقصى للحجم 800K.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">اسم الطالب/الطالبة</label>
                    <input type="text" class="form-control" value="أفنان">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">الرقم الجامعي</label>
                    <input type="text" class="form-control" value="44209836">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">اسم الجامعة</label>
                    <input type="text" class="form-control" value="جامعة الطائف">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">البريد الجامعي</label>
                    <input type="text" class="form-control" value="s44104047@students.tu.edu.sa">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" value="">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان</label>
                    <input type="text" class="form-control" value="الطائف - حي سلطانة">
                </div>
            </div>
            <div class="d-flex justify-content-start">
                <button class="btn btn-primary">حفظ التغييرات</button>
                <button class="btn btn-secondary ms-2">إلغاء</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
