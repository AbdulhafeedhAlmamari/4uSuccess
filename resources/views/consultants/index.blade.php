@extends('layouts.app')
@section('title')
    {{ __('عرض المستشارون') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <style>
        a.btn-primary {
            background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
            border: none;
            height: 45px;
        }
    </style>
@endsection
@section('content')
    <!-- consultants section -->
    <section class="consultants-section my-5">
        <div class="container my-5 ">
            <p class="consultants_header mb-5">المستشارون</p>
            <form action="{{ route('home.consultants') }}" method="GET">
                <div class="d-flex justify-content-center">
                    <select class="form-select ms-4" name="specialization" aria-label="Default select example">
                        <option value="">التخصص</option>
                        <option value="الذكاء الاصطناعي"
                            {{ request('specialization') == 'الذكاء الاصطناعي' ? 'selected' : '' }}>الذكاء الاصطناعي
                        </option>
                        <option value="إدارة الاعمال" {{ request('specialization') == 'إدارة الاعمال' ? 'selected' : '' }}>
                            إدارة الاعمال</option>
                        <option value="التربية الادبية"
                            {{ request('specialization') == 'التربية الادبية' ? 'selected' : '' }}>التربية الادبية</option>
                        <option value="علوم الحاسب" {{ request('specialization') == 'علوم الحاسب' ? 'selected' : '' }}>علوم
                            الحاسب</option>
                    </select>
                    <div class="form-check ms-4 mt-2">
                        <input class="form-check-input" type="radio" name="gender" value="ذكر" id="maleRadio"
                            {{ request('gender') == 'ذكر' ? 'checked' : '' }}>
                        <label class="form-check-label" for="maleRadio">
                            ذكر
                        </label>
                    </div>
                    <div class="form-check ms-4 mt-2">
                        <input class="form-check-input" type="radio" name="gender" value="انثى" id="femaleRadio"
                            {{ request('gender') == 'انثى' ? 'checked' : '' }}>
                        <label class="form-check-label" for="femaleRadio">
                            انثى
                        </label>
                    </div>
                    <button class="btn btn-primary ms-4" type="submit">بحث</button>
                </div>
            </form>

            @if (request('specialization') || request('gender'))
                <div class="container mt-3">
                    <div class="alert alert-info d-flex justify-content-between align-content-center">
                        <div>
                            <h5>نتائج البحث:</h5>
                            @if (request('specialization'))
                                <span class="badge bg-secondary me-2">التخصص: {{ request('specialization') }}</span>
                            @endif
                            @if (request('gender'))
                                <span class="badge bg-success me-2">الجنس:
                                    {{ request('gender') == 'ذكر' ? 'ذكر' : 'انثى' }}</span>
                            @endif
                        </div>
                        <a href="{{ route('home.consultants') }}" class="btn btn-primary   float-end w-auto">إلغاء
                            التصفية</a>
                        {{-- <a href="{{ route('home.consultants') }}"
                            class="btn btn-primary btn-outline-danger float-end w-auto">إلغاء التصفية</a> --}}
                    </div>
                </div>
            @endif

            <div class="container mb-5">
                <div class="row mt-5">
                    @forelse($consultants as $consultant)
                        <div class="col-lg-3 col-md-4 mt-3">
                            <div class="card border-0 shadow p-2 rounded-3">
                                @if (isset($consultant->user->profile_image))
                                    <img src="{{ asset($consultant->user->profile_image) }}"
                                        class="card-img-top rounded-circle w-50 m-auto" style="height: 150px" alt="صورة المستشار">
                                @else
                                    <img src="{{ asset('build/assets/images/consultant-01.png') }}"
                                        class="card-img-top rounded-circle h-25 w-50 m-auto" style="height: 200px" alt="صورة المستشار">
                                @endif
                                <div class="card-body px-0 m-0">
                                    <h5 class="card-title">{{ $consultant->user->name }}</h5>
                                    <p class="card-text">{{ $consultant->specialization ?? 'التخصص غير متوفر' }}</p>
                                    <div class="row mt-5">
                                        <div class="col-10">
                                            <a href="{{ route('home.consultants.show', $consultant->id) }}"
                                                class="btn btn-view">عـــــرض الحساب</a>
                                        </div>
                                        <div class="col-2">
                                            <i class="fa-regular fa-comment-dots fs-3" data-bs-toggle="modal"
                                                data-bs-target="#chatModal" data-consultant-id="{{ $consultant->id }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 mt-4">
                            @if (!request('specialization') === null || !request('gender') === null)
                                <div class="alert alert-info text-center">
                                    لا يوجد مستشارين متاحين حالياً.
                                </div>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    @include('components.chat-modal')
@endsection

@section('script')
    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
    <script src="{{ asset('build/assets/js/chat.js') }}"></script>
@endsection
