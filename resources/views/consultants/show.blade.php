@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل المستشار') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <style>
        .consultant-details .btn-primary {
            background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
            border: none;
        }
    </style>
@endsection
@section('content')
    <!-- consultants section -->

    <section class="container mt-5 consultant-details">
        <div class="card border-0">
            <div class="row g-0">
                <div class="col-md-4 w-25 h-75">
                    @if (isset($consultant->user->profile_image))
                        <img src="{{ asset($consultant->user->profile_image) }}" alt="صورة المستشار"
                            class="img-fluid rounded-3" style="width: 100%; height: 100%;">
                    @else
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" alt="صورة المستشار"
                            class="img-fluid rounded-3" style="width: 100%; height: 100%;">
                    @endif
                    <div class="w-100 d-flex flex-column justify-content-center align-items-center">
                        <h4 class="fw-bold mt-4">{{ $consultant->user->name ?? 'اسم المستشار غير متوفر' }}</h4>
                        {{-- <p class="text-muted">{{ $consultant->university ?? 'الجامعة غير متوفرة' }}</p> --}}
                        <button class="btn btn-primary rounded-pill px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#chatModal" data-consultant-id="{{ $consultant->id }}">دردشة</button>
                    </div>
                </div>
                <div class="col-md-8 p-4">
                    <h2 class="fw-bold text-center text-md-end">تفاصيل المستشار</h2>
                    <p><strong>التخصص:</strong> {{ $consultant->specialization ?? 'غير متوفر' }}</p>
                    <p><strong>مدة الاستشارة:</strong> {{ $consultant->consultation_duration ?? 'غير محدد' }} دقيقة
                    </p>
                    <p><strong>نوع النشاط:</strong> {{ $consultant->activity_type ?? 'غير محدد' }}</p>
                    <p><strong>الجنس:</strong> {{ $consultant->gender ?? 'غير محدد' }}</p>

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
