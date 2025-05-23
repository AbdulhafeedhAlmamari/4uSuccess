@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل النقل') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/transport.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- transports section -->
    <div class="container mt-5 transport-mass-container">
        <div class="row">
            <div class="col-md-6 hero-content">
                <h6 class="text-primary">
                    {{ $type == 'single' ? 'نقل فردي' : 'نقل جماعي' }}
                </h6>
                <h2 class="fw-bold">{{ $type == 'single' ? 'نقل فردي' : 'نقل جماعي' }}</h2>


                <p>
                    في "4uSuccess"، نؤمن بأن رحلة النجاح تبدأ بخطوة واثقة، ورؤية واضحة، ودعم لا محدود.
                    اختر مسارنا كونه مماثلاً للطريق الذي ترغب به، والمسار الذي ينير دربك، والراحة التامة التي تدعمك في
                    كل خطوة من خطوات رحلتك الجماعية.
                </p>
                <a href="{{ route('home.transport.search', ['type' => $type]) }}" class="btn btn-purple">ابدأ الرحلة</a>
            </div>
            <div class="col-md-6 image-container">
                @if ($type == 'single')
                    <img src="{{ asset('images/trans-single.png') }}" class="img-fluid rounded" alt="حافلة">
                @else
                    <img src="{{ asset('build/assets/images/Frame 694.png') }}" class="img-fluid rounded" alt="حافلة">
                @endif
                {{-- <img src="{{ asset('build/assets/images/Frame 694.png') }}" class="hero-img" alt="نقل جماعي"> --}}
            </div>
        </div>
    </div>
    <br><br>
@endsection
