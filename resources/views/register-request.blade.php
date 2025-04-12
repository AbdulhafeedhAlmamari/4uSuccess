@extends('layouts.app')
@section('title')
    {{ __('انضمام الى 4uSuccess') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/home.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin: 30px auto;
            max-width: 600px;
        }

        .form-header {
            /* text-align: center; */
            margin-bottom: 25px;
            color: #333;
            font-weight: bold;
        }

        .nav-tabs {
            border-bottom: none;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;

        }

        .nav-tabs .nav-link {
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            color: #333;
            border: 1px solid #dee2e6;
            margin-right: 10px;
            width: 200px;
        }

        .nav-tabs .nav-link.active {
            background-color: #6c5b9e;
            color: white;
            border-color: #6c5b9e;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

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
    <div class="container">
        <div class="form-container">
            <h4 class="form-header">املأ النموذج للانضمام</h4>

            <!-- Response Messages -->
            <div id="responseMessage" class="alert" style="display: none;"></div>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="formTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="companies-tab" data-bs-toggle="tab" data-bs-target="#companies"
                        type="button" role="tab">الشــــركات</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="consultant-tab" data-bs-toggle="tab" data-bs-target="#consultant"
                        type="button" role="tab">مستشار</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="formTabsContent">
                <!-- Companies Tab -->
                <div class="tab-pane fade show active" id="companies" role="tabpanel">
                    <!-- Company Type Selection -->
                    <div class="mb-3">
                        <label for="companyType" class="form-label">نوع الشركة</label>
                        <select class="form-select form-control" id="companyType">
                            <option selected disabled>اختر نوع الشركة</option>
                            <option value="transportation">{{ __('النقل') }}</option>
                            <option value="housing">{{ __('السكن') }}</option>
                            <option value="financing">{{ __('التمويل') }}</option>
                        </select>
                        <div class="invalid-feedback" id="companyType-error"></div>
                    </div>

                    <form id="companyRegisterForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="companyName" class="form-label">اســــم الشركة</label>
                            <input type="text" class="form-control" id="companyName" name="companyName">
                            <div class="invalid-feedback" id="companyName-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="commercialReg" class="form-label">السجــــل التجاري</label>
                            <input type="text" class="form-control" id="commercialReg" name="commercialReg">
                            <div class="invalid-feedback" id="commercialReg-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="companyEmail" class="form-label">البريد الالكتروني</label>
                            <input type="email" class="form-control" id="companyEmail" name="companyEmail">
                            <div class="invalid-feedback" id="companyEmail-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="companyPassword" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="companyPassword" name="companyPassword"
                                placeholder="*****************">
                            <div class="invalid-feedback" id="companyPassword-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="companyPassword_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" id="companyPassword_confirmation"
                                name="companyPassword_confirmation" placeholder="*****************">
                            <div class="invalid-feedback" id="companyPassword_confirmation-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="companyPhone" class="form-label">رقم الهاتف</label>
                            <input type="tel" class="form-control" id="companyPhone" name="companyPhone">
                            <div class="invalid-feedback" id="companyPhone-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">إرفاق صورة من الهوية الوطنية</label>
                            <div class="upload-area">
                                <input type="file" class="file-input" id="companyIdUpload" name="companyIdUpload">
                                <div class="upload-icon">
                                    <i class="fas fa-arrow-up-from-bracket"></i>
                                </div>
                                <div class="upload-text">تحميل الملف</div>
                            </div>
                            <div class="invalid-feedback" id="companyIdUpload-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">نســــخة مــن السجل التجاري</label>
                            <div class="upload-area">
                                <input type="file" class="file-input" id="commercialRegUpload"
                                    name="commercialRegUpload">
                                <div class="upload-icon">
                                    <i class="fas fa-arrow-up-from-bracket"></i>
                                </div>
                                <div class="upload-text">تحميل الملف</div>
                            </div>
                            <div class="invalid-feedback" id="commercialRegUpload-error"></div>
                        </div>

                        <button type="submit" class="submit-btn" id="companySubmitBtn">
                            <i class="fas fa-paper-plane"></i> إرســــال
                        </button>
                    </form>
                </div>

                <!-- Consultant Tab -->
                <div class="tab-pane fade" id="consultant" role="tabpanel">
                    <form id="consultantRegisterForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="fullName" class="form-label">الاســــم الرباعي</label>
                            <input type="text" class="form-control" id="fullName" name="fullName">
                            <div class="invalid-feedback" id="fullName-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="activityType" class="form-label">نوع النشــــاط</label>
                            <input type="text" class="form-control" id="activityType" name="activityType">
                            <div class="invalid-feedback" id="activityType-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="consultationDuration" class="form-label">مدة الاستشــــارة</label>
                            <select class="form-select form-control" id="consultationDuration"
                                name="consultationDuration">
                                <option selected disabled>المــــدة</option>
                                <option value="3 شهور">3 شهور</option>
                                <option value="6 شهور">6 شهور</option>
                                <option value="12 شهور">12 شهور</option>
                            </select>
                            <div class="invalid-feedback" id="consultationDuration-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="specialization" class="form-label">التخصص</label>
                            <select class="form-select form-control" id="specialization" name="specialization">
                                <option selected disabled>اختــر التخصص</option>
                                <option value="الذكاء الاصطناعي">الذكاء الاصطناعي</option>
                                <option value="إدارة أعمال">إدارة أعمال</option>
                                <option value="التنمية البشرية">التنمية البشرية</option>
                                <option value="علوم الحاسوب">علوم الحاسوب</option>
                            </select>
                            <div class="invalid-feedback" id="specialization-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريــــد الالكتروني</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="invalid-feedback" id="email-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="*****************">
                            <div class="invalid-feedback" id="password-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="*****************">
                            <div class="invalid-feedback" id="password_confirmation-error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                            <div class="invalid-feedback" id="phone-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">إرفاق صورة من الهوية الوطنية</label>
                            <div class="upload-area">
                                <input type="file" class="file-input" id="idUpload" name="idUpload">
                                <div class="upload-icon">
                                    <i class="fas fa-arrow-up-from-bracket"></i>
                                </div>
                                <div class="upload-text">تحميل الملف</div>
                            </div>
                            <div class="invalid-feedback" id="idUpload-error"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">إرفاق صورة من الشهادة العلمية</label>
                            <div class="upload-area">
                                <input type="file" class="file-input" id="certificateUpload"
                                    name="certificateUpload">
                                <div class="upload-icon">
                                    <i class="fas fa-arrow-up-from-bracket"></i>
                                </div>
                                <div class="upload-text">تحميل الملف</div>
                            </div>
                            <div class="invalid-feedback" id="certificateUpload-error"></div>
                        </div>

                        <button type="submit" class="submit-btn" id="consultantSubmitBtn">
                            <i class="fas fa-paper-plane"></i> إرســــال
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Simple file upload preview functionality
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                if (fileName) {
                    const uploadText = this.parentElement.querySelector('.upload-text');
                    uploadText.textContent = fileName;
                }
            });
        });

        // Consultant Registration Form Submission
        $('#consultantRegisterForm').submit(function(e) {
            e.preventDefault();

            // Reset error messages and classes
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#responseMessage').hide();

            // Create FormData object
            const formData = new FormData(this);

            // Submit form via AJAX
            $.ajax({
                url: "{{ route('consultant.register') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#consultantSubmitBtn').prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...');
                },
                success: function(response) {
                    $('#responseMessage').removeClass('alert-danger').addClass('alert-success').text(
                        response.message).show();
                    $('#consultantRegisterForm')[0].reset();
                    $('.upload-text').text('تحميل الملف');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            $(`#${key}`).addClass('is-invalid');
                            $(`#${key}-error`).text(errors[key][0]).show();
                        }
                    } else {
                        $('#responseMessage').removeClass('alert-success').addClass('alert-danger')
                            .text('حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.').show();
                    }
                },
                complete: function() {
                    $('#consultantSubmitBtn').prop('disabled', false).html(
                        '<i class="fas fa-paper-plane"></i> إرســــال');
                }
            });
        });

        // Company Registration Form Submission
        $('#companyRegisterForm').submit(function(e) {
            e.preventDefault();

            // Reset error messages and classes
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#responseMessage').hide();

            // Get company type
            const companyType = $('#companyType').val();
            if (!companyType) {
                $('#companyType').addClass('is-invalid');
                $('#companyType-error').text('يرجى اختيار نوع الشركة').show();
                return;
            }

            // Create FormData object
            const formData = new FormData(this);
            formData.append('companyType', companyType);

            // Determine the route based on company type
            let route;
            switch (companyType) {
                case 'transportation':
                    route = "{{ route('transportation.register') }}";
                    break;
                case 'housing':
                    route = "{{ route('housing.register') }}";
                    break;
                case 'financing':
                    route = "{{ route('financing.register') }}";
                    break;
                default:
                    $('#companyType').addClass('is-invalid');
                    $('#companyType-error').text('نوع الشركة غير صالح').show();
                    return;
            }

            // Submit form via AJAX
            $.ajax({
                url: route,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#companySubmitBtn').prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...');
                },
                success: function(response) {
                    $('#responseMessage').removeClass('alert-danger').addClass('alert-success').text(
                        response.message).show();
                    $('#companyRegisterForm')[0].reset();
                    $('#companyType').val('');
                    $('.upload-text').text('تحميل الملف');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            $(`#${key}`).addClass('is-invalid');
                            $(`#${key}-error`).text(errors[key][0]).show();
                        }
                    } else {
                        $('#responseMessage').removeClass('alert-success').addClass('alert-danger')
                            .text('حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.').show();
                    }
                },
                complete: function() {
                    $('#companySubmitBtn').prop('disabled', false).html(
                        '<i class="fas fa-paper-plane"></i> إرســــال');
                }
            });
        });
    </script>
@endsection
