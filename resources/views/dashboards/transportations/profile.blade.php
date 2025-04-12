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
            max-width: 100%;
            max-height: 120px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 5px;
        }
        
        .invalid-feedback {
            display: block;
            color: #dc3545;
            margin-top: -15px;
            margin-bottom: 15px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
@endsection
@section('content')
    <!-- profile section -->
    <div class="container mt-5">
        <!-- Response Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <div id="responseMessage" class="alert" style="display: none;"></div>
        
        <div class="card p-4">
            <h4 class="mb-4">تفاصيل الملف الشخصي</h4>
            <form id="profileForm" method="POST" action="{{ route('transportation.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <div class="profile-img">
                            @if($user->profile_image)
                                <img src="{{ asset($user->profile_image) }}" id="profileImagePreview" alt="صورة الملف الشخصي">
                            @else
                                <img src="{{ asset('build/assets/images/cons-1.jpg') }}" id="profileImagePreview" alt="صورة الملف الشخصي">
                            @endif
                        </div>
                    </div>
                    <div class="col mt-4">
                        <input type="file" id="profileImageUpload" name="profile_image" class="d-none" accept="image/*">
                        <button type="button" class="btn btn-primary" onclick="$('#profileImageUpload').click()">تحميل صورة جديدة</button>
                        <button type="button" class="btn btn-secondary btn-reset">إعادة ضبط</button>
                        <p class="text-muted small mt-1">مسموح ب JPG أو GIF أو PNG. الحد الأقصى للحجم 800K.</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">اسم الشركة / السائق</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $transportationCompany->phone_number ?? '' }}" required>
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">السجل التجاري</label>
                        <input type="text" class="form-control" id="commercial_register_number" name="commercial_register_number" value="{{ $transportationCompany->commercial_register_number ?? '' }}" required>
                        @error('commercial_register_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                            @if($transportationCompany && $transportationCompany->identity_image)
                                <img src="{{ asset($transportationCompany->identity_image) }}" alt="{{ $transportationCompany->identity_image }}" id="identityImagePreview" class="preview-img mb-2" width="100px" height="100px">
                            @else
                                <img src="{{ asset('build/assets/images/upload.png') }}" id="identityImagePreview" class="preview-img mb-2" width="100px" height="100px">
                            @endif
                            <span class="fw-bold">الهوية الوطنية</span>
                            <small class="text-muted">تحميل الملفات المحددة.</small>
                            <input type="file" id="identityImageUpload" name="identity_image" accept="image/*">
                        </label>
                        @error('identity_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                            @if($transportationCompany && $transportationCompany->commercial_register_image)
                                <img src="{{ asset($transportationCompany->commercial_register_image) }}"  id="commercialImagePreview" class="preview-img mb-2" width="100px" height="100px">
                            @else
                                <img src="{{ asset('build/assets/images/upload.png') }}" id="commercialImagePreview" class="preview-img mb-2" width="100px" height="100px">
                            @endif
                            <span class="fw-bold">صورة لوحة المركبة ورخصة السائق</span>
                            <small class="text-muted">تحميل الملفات المحددة.</small>
                            <input type="file" id="commercialImageUpload" name="commercial_register_image" accept="image/*">
                        </label>
                        @error('commercial_register_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary" id="submitBtn">حفظ التغييرات</button>
                    <a href="{{ route('dashboard.transportations') }}" class="btn btn-secondary ms-2">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Preview profile image before upload
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
        
        $(document).ready(function() {
            // Profile image upload preview
            $('#profileImageUpload').change(function(event) {
                previewImage(event, 'profileImagePreview');
            });
            
            // Identity image upload preview
            $('#identityImageUpload').change(function(event) {
                previewImage(event, 'identityImagePreview');
            });
            
            // Commercial register image upload preview
            $('#commercialImageUpload').change(function(event) {
                previewImage(event, 'commercialImagePreview');
            });
            
            // Reset button functionality
            $('.btn-reset').click(function(e) {
                e.preventDefault();
                @if($user->profile_image)
                    $('#profileImagePreview').attr('src', '{{ asset($user->profile_image) }}');
                @else
                    $('#profileImagePreview').attr('src', '{{ asset('build/assets/images/cons-1.jpg') }}');
                @endif
                $('#profileImageUpload').val('');
            });
            
            // Form validation and submission
            $('#profileForm').submit(function(e) {
                e.preventDefault();
                
                // Reset validation states
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').hide();
                $('#responseMessage').hide();
                
                // Validate required fields
                let isValid = true;
                $('.form-control[required]').each(function() {
                    if ($(this).val().trim() === '') {
                        $(this).addClass('is-invalid');
                        const errorElement = $(this).next('.invalid-feedback');
                        if (errorElement.length) {
                            errorElement.text('هذا الحقل مطلوب').show();
                        } else {
                            $(this).after('<div class="invalid-feedback">هذا الحقل مطلوب</div>');
                        }
                        isValid = false;
                    }
                });
                
                // Validate email format
                const emailField = $('#email');
                if (emailField.length && emailField.val() && !isValidEmail(emailField.val())) {
                    emailField.addClass('is-invalid');
                    const errorElement = emailField.next('.invalid-feedback');
                    if (errorElement.length) {
                        errorElement.text('يرجى إدخال بريد إلكتروني صحيح').show();
                    } else {
                        emailField.after('<div class="invalid-feedback">يرجى إدخال بريد إلكتروني صحيح</div>');
                    }
                    isValid = false;
                }
                
                // Validate phone format
                const phoneField = $('#phone_number');
                if (phoneField.length && phoneField.val() && !isValidPhone(phoneField.val())) {
                    phoneField.addClass('is-invalid');
                    const errorElement = phoneField.next('.invalid-feedback');
                    if (errorElement.length) {
                        errorElement.text('يرجى إدخال رقم هاتف صحيح').show();
                    } else {
                        phoneField.after('<div class="invalid-feedback">يرجى إدخال رقم هاتف صحيح</div>');
                    }
                    isValid = false;
                }
                
                if (!isValid) return;
                
                // Create FormData object to handle file uploads
                const formData = new FormData(this);
                
                // Disable submit button and show loading state
                $('#submitBtn').prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري الحفظ...'
                );
                
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Show success message
                            $('#responseMessage')
                                .removeClass('alert-danger')
                                .addClass('alert-success')
                                .text(response.message || 'تم تحديث الملف الشخصي بنجاح')
                                .show();
                                
                            // Scroll to the top of the page to show the message
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                        } else {
                            // Show error message
                            $('#responseMessage')
                                .removeClass('alert-success')
                                .addClass('alert-danger')
                                .text(response.message || 'حدث خطأ أثناء تحديث الملف الشخصي')
                                .show();
                        }
                    },
                    error: function(xhr) {
                        console.error('Error response:', xhr);
                        
                        if (xhr.status === 422) {
                            // Validation errors
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                const errorElement = $('#' + key).next('.invalid-feedback');
                                if (errorElement.length) {
                                    errorElement.text(value[0]).show();
                                } else {
                                    $('#' + key).after('<div class="invalid-feedback">' + value[0] + '</div>');
                                }
                            });
                        } else {
                            // Other errors
                            let errorMessage = 'حدث خطأ أثناء تحديث الملف الشخصي';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            
                            $('#responseMessage')
                                .removeClass('alert-success')
                                .addClass('alert-danger')
                                .text(errorMessage)
                                .show();
                                
                            // Scroll to the top of the page to show the message
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                        }
                    },
                    complete: function() {
                        $('#submitBtn').prop('disabled', false).text('حفظ التغييرات');
                    }
                });
            });
        });
        
        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
        
        function isValidPhone(phone) {
            const regex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
            return regex.test(phone);
        }
    </script>
@endsection