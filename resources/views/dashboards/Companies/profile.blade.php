@extends('layouts.app')
@section('title')
    {{ __('الملف الشخصي') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/profile.css') }}" rel="stylesheet">
    <style>
        .card {
            border-style: dashed;
            padding: 10px;
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            min-height: 150px;
            position: relative;
        }

        .upload-box:hover {
            border-color: #6c757d;
        }

        .upload-box input {
            display: none;
        }

        .upload-icon {
            font-size: 30px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .preview-img {
            /* display: none; */
            max-width: 100%;
            max-height: 120px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
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
                    <label class="form-label">اسم الشركة / السائق</label>
                    <input type="text" class="form-control" value="السائق معاذ">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">البريد الالكتروني</label>
                    <input type="text" class="form-control" value="transport@gmail.com">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" value="+965 555 555 555">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">السجل التجاري</label>
                    <input type="text" class="form-control" value="s44104047@students.tu.edu.sa">
                </div>
                <div class="col-md-6">
                    <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                        <img src="{{ asset('build/assets/images/upload.png') }}" id="preview1" class="preview-img mb-2"
                            width="100px" height="100px">
                        <span class="fw-bold"> الهوية الوطنية</span>
                        <small class="text-muted"> تحميل الملفات المحددة. </small>
                        <input type="file" accept="image/*" onchange="previewImage(event, 'preview1')">
                    </label>
                </div>

                <div class="col-md-6">
                    <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                        <img src="{{ asset('build/assets/images/upload.png') }}" id="preview2" class="preview-img mb-2"
                            width="100px" height="100px">
                        <span class="fw-bold"> صورة لوحة المركبة ورخصة السائق</span>
                        <small class="text-muted"> تحميل الملفات المحددة. </small>
                        <input type="file" accept="image/*" onchange="previewImage(event, 'preview2')">
                    </label>
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
