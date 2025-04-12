<!-- login modal -->
<div class="modal modal-md login-modal" tabindex="-1" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-body">
                <div class="row pe-3 ps-3">
                    <div class="col-6 mt-3 pb-5">
                        <p class="login-title text-center">تسجيل دخول</p>
                        <form id="loginForm" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الالكتروني</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@demo.com">
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="*****************">
                                <div class="invalid-feedback" id="password-error"></div>
                            </div>
                            <div class="alert alert-danger" id="loginError" style="display: none;"></div>
                            <button type="submit" class="btn btn-login mt-3" id="loginBtn">تسجيل دخول</button>
                            <div class="mt-3">
                                <a href="#" class="register-link" data-bs-toggle="modal" data-bs-target="#registerModal">إنشاء حساب جديد (للطلاب فقط)</a>
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
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            
            // Reset error messages and classes
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#loginError').hide();
            
            // Disable submit button and show loading state
            $('#loginBtn').prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> جاري تسجيل الدخول...'
            );
            
            // Submit form via AJAX
            $.ajax({
                url: "{{ route('login') }}",
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        $('#loginError').text(response.message).show();
                    }
                },
                error: function(xhr) {
                    $('#loginBtn').prop('disabled', false).text('تسجيل دخول');
                    
                    if (xhr.status === 422) {
                        // Validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '-error').text(value[0]);
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        $('#loginError').text(xhr.responseJSON.message).show();
                    } else {
                        $('#loginError').text('حدث خطأ أثناء تسجيل الدخول. يرجى المحاولة مرة أخرى.').show();
                    }
                },
                complete: function() {
                    $('#loginBtn').prop('disabled', false).text('تسجيل دخول');
                }
            });
        });
    });
</script>