<!-- register modal -->
<div class="modal modal-md login-modal " tabindex="-1" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row pe-3 ps-3">
                    <div class="col-6 mt-3 pb-5">
                        <p class="login-title text-center">تسجيل حساب طالب</p>
                        <form id="studentRegisterForm" method="POST">
                            @csrf

                            <!-- User Information -->
                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="أدخل اسمك الكامل">
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الالكتروني</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="example@demo.com">
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="*****************">
                                <div class="invalid-feedback" id="password-error"></div>
                            </div>

                            <!-- Student Information -->
                            <div class="mb-3">
                                <label for="university_number" class="form-label">الرقم الجامعي</label>
                                <input type="text" class="form-control" id="university_number"
                                    name="university_number" placeholder="أدخل الرقم الجامعي">
                                <div class="invalid-feedback" id="university_number-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="university_name" class="form-label">اسم الجامعة</label>
                                <select class="form-control" id="university_name" name="university_name">
                                    <option value="" selected disabled>اختر اسم الجامعة</option>
                                    <option value="جامعة الإمام محمد بن سعود الإسلامية">جامعة الإمام محمد بن سعود
                                        الإسلامية</option>
                                    <option value="جامعة الطائف">جامعة الطائف</option>
                                    <option value="جامعة الملك خالد">جامعة الملك خالد</option>
                                    <option value="جامعة الملك فيصل">جامعة الملك فيصل</option>
                                    <option value="جامعة أم القرى">جامعة أم القرى</option>
                                    <option value="جامعة الجوف">جامعة الجوف</option>
                                    <option value="جامعة الملك سعود">جامعة الملك سعود</option>
                                    <option value="جامعة الملك عبد العزيز">جامعة الملك عبد العزيز</option>
                                    <option value="جامعة الملك فهد للبترول والمعادن">جامعة الملك فهد للبترول والمعادن
                                    </option>
                                </select>
                                <div class="invalid-feedback" id="university_name-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="student_address" class="form-label">عنوان السكن</label>
                                <input type="text" class="form-control" id="student_address" name="student_address"
                                    placeholder="أدخل عنوان السكن">
                                <div class="invalid-feedback" id="student_address-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="student_phone_number" class="form-label">رقم الهاتف</label>
                                <input type="tel" class="form-control" id="student_phone_number"
                                    name="student_phone_number" placeholder="أدخل رقم الهاتف">
                                <div class="invalid-feedback" id="student_phone_number-error"></div>
                            </div>

                            <button type="submit" class="btn btn-login mt-3" id="registerBtn">تسجيل حساب</button>

                            <div class="mt-3">
                                <a href="javascript:void(0);" class="register-link">لديك حساب بالفعل؟ تسجيل دخول</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-6 pb-5 login-bg">
                        <p class="mt-5 pt-5 login-sidetitle">الشركات - المستشـــــارين</p>
                        <p class="mt-5 pt-5 login-subtitle">ابـــدأوا تجربتكم المميزة معنـا</p>
                        <a href="{{ route('join.us') }}" class="btn btn-joing mt-5">انضـــــــم الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#studentRegisterForm').submit(function(e) {
            e.preventDefault();

            // Reset error messages and classes
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            // Disable submit button and show loading state
            $('#registerBtn').prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري التسجيل...'
            );

            $.ajax({
                url: '{{ route('student.register') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    $('#registerBtn').prop('disabled', false).text('تسجيل حساب');

                    if (xhr.status === 422) {
                        // Validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '-error').text(value[0]);
                        });
                    } else {
                        // Other errors
                        alert('حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.');
                    }
                }
            });
        });
    });
</script>
