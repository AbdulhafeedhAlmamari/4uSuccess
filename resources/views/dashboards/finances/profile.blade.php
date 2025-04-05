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
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label">اسم شركة التمويل</label>
                    <input type="text" class="form-control" value="سليمان الراجحي ">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">السجل التجاري</label>
                    <input type="text" class="form-control" value="رقم السجل التجاري">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">البريد الالكتروني</label>
                    <input type="text" class="form-control" value="fintace@gmail.com">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" value="+965 555 555 555">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">العنوان</label>
                    <textarea class="form-control" value="عنوان الشركة"></textarea>
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
