@extends('layouts.app')
@section('title')
    {{ __('طلب استشارة') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/or.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- consultation request section -->
    <section class="container justify-items-center">
        <div class="card mt-5 mb-5">
            <div class="card-body">
                <p class="text-center mb-4 title">إرسال طلب استشارة</p>

                <form action="{{ route('consultation.request.store') }}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="specialization" class="form-label">التخصص</label>
                                <select name="specialization" id="specialization"
                                    class="form-select @error('specialization') is-invalid @enderror">
                                    <option disabled selected>اختار التخصص</option>
                                    <option value="الذكاء الاصطناعي"
                                        {{ old('specialization') == 'الذكاء الاصطناعي' ? 'selected' : '' }}>الذكاء الاصطناعي
                                    </option>
                                    <option value="إدارة الاعمال"
                                        {{ old('specialization') == 'إدارة الاعمال' ? 'selected' : '' }}>إدارة الاعمال
                                    </option>
                                    <option value="التربية الادبية"
                                        {{ old('specialization') == 'التربية الادبية' ? 'selected' : '' }}>التربية الادبية
                                    </option>
                                    <option value="علوم الحاسب"
                                        {{ old('specialization') == 'علوم الحاسب' ? 'selected' : '' }}>علوم الحاسب</option>
                                </select>
                                @error('specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="gender" class="form-label">الجنس</label>
                                <select name="gender" id="gender"
                                    class="form-select @error('gender') is-invalid @enderror">
                                    <option hidden disabled selected>حدد الجنس</option>
                                    <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                    <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="consultant_id" class="form-label">اسم المستشار</label>
                                <select name="consultant_id" id="consultant_id"
                                    class="form-select @error('consultant_id') is-invalid @enderror">
                                    <option hidden disabled selected>اختار المستشار</option>
                                    @foreach ($consultants ?? [] as $consultant)
                                        <option value="{{ $consultant->id }}"
                                            {{ old('consultant_id') == $consultant->id ? 'selected' : '' }}>
                                            {{ $consultant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('consultant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="consultation_type" class="form-label">نوع الاستشاره</label>
                                <select name="consultation_type" id="consultation_type"
                                    class="form-select @error('consultation_type') is-invalid @enderror">
                                    <option value="استشاره علمية"
                                        {{ old('consultation_type') == 'استشاره علمية' ? 'selected' : '' }}>استشاره علمية
                                    </option>
                                    <option value="استشاره أدابية"
                                        {{ old('consultation_type') == 'استشاره أدابية' ? 'selected' : '' }}>استشاره أدابية
                                    </option>
                                </select>
                                @error('consultation_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="subject" class="form-label">موضوع الإستشاره</label>
                                <input type="text" name="subject" id="subject"
                                    class="form-control @error('subject') is-invalid @enderror"
                                    placeholder="اكتب موضوع الإستشاره" value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="message" class="form-label">نص الطلب</label>
                                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror"
                                    placeholder="أكتب نص طلبك الى المستشار" rows="4">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">إرسال</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('build/assets/js/chat.js') }}"></script>
    <script>
        // Filter consultants based on specialization and gender
        $(document).ready(function() {
            $('#specialization, #gender').change(function() {
                const specialization = $('#specialization').val();
                const gender = $('#gender').val();

                if (specialization && gender) {
                    $.ajax({
                        url: "{{ route('filter.consultants') }}",
                        type: "GET",
                        data: {
                            specialization: specialization,
                            gender: gender
                        },
                        success: function(response) {
                            let options =
                                '<option hidden disabled selected>اختار المستشار</option>';

                            $.each(response.consultants, function(key, consultant) {
                                options +=
                                    `<option value="${consultant.id}">${consultant.name}</option>`;
                            });

                            $('#consultant_id').html(options);
                        }
                    });
                }
            });
        });
    </script>
@endsection
