@extends('layouts.app')

@section('title')
    {{ __('الصفحة الرئيسية') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/home.css') }}" rel="stylesheet">
    <style>
        /* text-truncate */
        .text-truncate-multiline {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 3.6em;

        }

        .rooms-section .card .card-body {
            height: 185px;
        }

        .star-container .stars-inactive {
            position: absolute;
            top: 0px;
            /* left: 104px; */
        }

        .star-container {
            width: 55%
        }

        .stars-inactive {
            /* color: #ccc; */

        }



        .stars-active {
            color: #54B6B7;
            !important;
            position: relative;
            z-index: 10;
            display: block;
            overflow: hidden;
            white-space: nowrap;
        }

        .rating-star {
            font-size: 24px;
            /* color: #ccc; */
            cursor: pointer;
        }

        .rating-star.checked {
            color: #54B6B7;

        }
    </style>
@endsection

@section('content')
    {{-- header --}}
    @include('layouts.header')

    <!-- consltant section -->
    <section class="rooms-section my-5">
        <div class="container my-5 ">
            <div class="rooms-titles d-flex justify-content-between mb-3">
                <h2 class=" mb-4">المستشارون المتخصصون</h2>
                <a href="{{ route('home.consultants') }}" class="text-decoration-none">
                    <h2 class=" mb-4">عرض الكل</h2>
                </a>
            </div>
            <div class="scroll-container d-flex " id="scrollContainerConsltant">
                @forelse($consultants as $consultant)
                    <div class="col-md-4">
                        <div class="card position-relative shadow">
                            @if (isset($consultant->user->profile_image))
                                <img src="{{ asset($consultant->user->profile_image) }}" class="card-img-top"
                                    alt="صورة المستشار">
                            @else
                                <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top"
                                    alt="صورة المستشار">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $consultant->user->name }}</h5>
                                <p class="card-text text-muted">{{ $consultant->specialization ?? 'التخصص غير متوفر' }}</p>
                                <div class="star-container   position-relative">
                                    <span class="stars-active" style="width:{{ $consultant->rate() * 20 }}% ">
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                    </span>

                                    <span class="stars-inactive">
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                    </span>
                                </div>
                                <div class="container-card-footer d-flex justify-content-between ">
                                    {{-- <p class="text-muted mb-0 pt-1"><i
                                            class="fas fa-map-marker-alt ms-1"></i>{{ $consultant->university ?? 'الجامعة غير متوفرة' }}
                                    </p> --}}
                                    <a href="{{ route('home.consultants.show', $consultant->id) }}">
                                        <div class="d-flex justify-content-between border px-3 rounded-pill">
                                            <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                            <i class="fa-regular fa-newspaper me-3 text-center py-2 m-0"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">لا يوجد مستشارين متاحين حالياً</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- rooms section -->
    <section class="rooms-section my-5">
        <div class="container my-5 ">
            <div class="rooms-titles d-flex justify-content-between mb-3">
                <h2 class=" mb-4">عروض السكن الجامعي</h2>
                <a href="{{ route('home.houses') }}" class="text-decoration-none">
                    <h2 class=" mb-4">عرض الكل</h2>
                </a>
            </div>
            <div class="scroll-container d-flex " id="scrollContainer">
                @forelse($houses as $house)
                    <div class="col-md-4">
                        <div class="card position-relative shadow">
                            <span class="price-badge">
                                {{ isset($house->price) ? rtrim(rtrim(number_format($house->price, 2, '.', ''), '0'), '.') : '0' }}
                                ريال
                            </span>

                            @if (isset($house->primaryPhoto))
                                <div class="image-container">
                                    <img src="{{ asset($house->primaryPhoto->path) }}" class="card-img-top"
                                        alt="صورة السكن">
                                </div>
                            @else
                                <div class="image-container">
                                    <img src="{{ asset('build/assets/images/bad2.jpg') }}" class="card-img-top"
                                        alt="صورة السكن">
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $house->title ?? 'سكن جامعي' }}</h5>
                                <p class="card-text text-muted text-truncate-multiline">
                                    {{ $house->description ?? 'وصف غير متوفر' }}
                                </p>
                                {{-- <p class="text-warning"> --}}
                                <div class="star-container   position-relative">
                                    <span class="stars-active" style="width:{{ $house->rate() * 20 }}% ">
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                    </span>

                                    <span class="stars-inactive">
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                        <i class="fas fa-star ms-2"></i>
                                    </span>
                                </div>
                                {{-- @for ($i = 0; $i < ($house->rating ?? 5); $i++)
                                    <i class="fas fa-star ms-2"></i>
                                @endfor --}}
                                {{-- </p> --}}
                                <div class="container-card-footer d-flex justify-content-between ">
                                    <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن
                                        {{ $house->distance_from_university ?? '؟' }}
                                        كيلو
                                    </p>
                                    <a href="{{ route('houses.show', $house->id) }}">
                                        <div class="d-flex justify-content-between border px-3 rounded-pill">
                                            <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                            <i class="fa-regular fa-newspaper me-3 text-center py-2 m-0"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">لا توجد مساكن متاحة حالياً</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- company section -->
    <section class="rooms-section my-5 company-section">
        <div class="container my-5 ">
            <div class="rooms-titles d-flex justify-content-between mb-3">
                <h2 class=" mb-4">شــركات التمويل المالي </h2>
                <a href="{{ route('home.finances') }}" class="text-decoration-none">
                    <h2 class=" mb-4">عرض الكل</h2>
                </a>
            </div>
            <div class="scroll-container d-flex " id="scrollContainerCompany">
                @forelse($financings as $financing)
                    <div class="col-md-2 ms-3">
                        <div class="card border ">
                            @if (isset($financing->user->profile_image))
                                <img src="{{ asset($financing->user->profile_image) }}" class="card-img-top"
                                    alt="شعار الشركة">
                            @else
                                <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top"
                                    alt="شعار الشركة">
                            @endif
                        </div>
                        <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                            <p class="">{{ $financing->user->name ?? 'شركة تمويل' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">لا توجد شركات تمويل متاحة حالياً</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
@endsection
