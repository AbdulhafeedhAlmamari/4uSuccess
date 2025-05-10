@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل المستشار') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/house.css') }}" rel="stylesheet">
    <style>
        .star-container .stars-inactive {
            position: absolute;
            top: 0px;
            /* left: 104px; */
        }

        .star-container {
            /* width: 31%; */
            width: 26%;
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
            ;
        }
    </style>
@endsection
@section('content')
    <!-- houses section -->
    <section class="houses-section my-5 house-section">
        <div class="container mt-5">
            <div class="row">
                <h3 class="card-title my-4">تفاصيل السكن</h3>
                <div class="col-md-8">
                    <!-- Main Housing Card -->
                    <div class="card housing-card">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="col-12">
                                    <div class="image-container">
                                        @if (isset($house->primaryPhoto))
                                            <img src="{{ asset($house->primaryPhoto->path) }}"
                                                class="card-img-top h-100 w-100 rounded-start" alt="صورة السكن"
                                                id="mainImage">
                                        @else
                                            <img src="{{ asset('images/default.jpeg') }}"
                                                class="card-img-top h-100 w-100 rounded-start" alt="صورة السكن">
                                        @endif
                                    </div>
                                </div>

                                <!-- Carousel Sub Images -->
                                <div id="subImageCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($house->photos->chunk(3) as $chunkIndex => $chunk)
                                            <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                                <div class="d-flex justify-content-center">
                                                    @foreach ($chunk as $photo)
                                                        @if ($photo->path)
                                                            <img onclick="changeMainImage(this)"
                                                                src="{{ asset($photo->path) }}" alt="صورة السكن"
                                                                class="mx-2 active">
                                                        @else
                                                            <img src="{{ asset('images/default.jpeg') }}"
                                                                class="card-img-top h-100 w-100 rounded-start"
                                                                alt="صورة السكن">
                                                        @endif
                                                        {{-- <img onclick="changeMainImage(this)" src="{{ asset($photo->path) }}"
                                                            alt="صورة السكن" class="mx-2"> --}}
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#subImageCarousel"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon arrow" aria-hidden="true"></span>
                                        <span class="visually-hidden">السابق</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#subImageCarousel"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon arrow" aria-hidden="true"></span>
                                        <span class="visually-hidden">التالي</span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><strong>العنوان:</strong> {{ $house->address }}</li>
                                        <li><strong>المسافة:</strong> يبعد عنك {{ $house->distance_from_university }} كيلو
                                        </li>
                                        <li><strong>السعر:</strong> {{ $house->price }} ريال شهرياً</li>
                                        <li><strong>نوع الغرف:</strong> {{ $house->housing_type }}</li>
                                        <li><strong>المميزات:</strong> {{ $house->features }}</li>
                                        <li><strong>وصف:</strong> {{ $house->description }}</li>
                                        <li><strong>القواعد:</strong> {{ $house->rules }}</li>
                                        <li>
                                            <span><strong>التقييمات:</strong>
                                            <div class="star-container   position-relative">
                                                <span class="stars-active" style="width:{{ $house->rate() * 20 }}% ">
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                </span>

                                                <span class="stars-inactive">
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                    <span> &#9733;</span>
                                                </span>
                                            </div>
                                        </li>
                                        <li>
                                            <form action="{{ route('houses.reservation.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="housing_id" value="{{ $house->id }}">
                                                <button type="submit" class="btn form-control w-50">تأكيد الحجز</button>
                                            </form>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Image Gallery -->
                    <div class="mt-4">
                        <h5 class="mb-3">ذات صلة</h5>
                        <div class="row gallery g-3">
                            @forelse($relatedHouses as $related)
                                <div class="col-3">
                                    <a href="{{ route('houses.show', $related->id) }}">
                                        @if ($related->primaryPhoto)
                                            <img src="{{ asset($related->primaryPhoto->path) }}"
                                                class="img-fluid rounded shadow-sm" alt="سكن ذات صلة">
                                        @else
                                            <img src="{{ asset('images/default.jpeg') }}"
                                                class="img-fluid rounded shadow-sm" alt="سكن ذات صلة">
                                        @endif
                                        {{-- <img src="{{ asset($related->primaryPhoto?->path ?? 'build/assets/images/default.jpeg') }}"
                                            class="img-fluid rounded shadow-sm" alt="سكن ذات صلة"> --}}
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>لا توجد سكنات مشابهة حالياً.</p>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

@section('script')
    <script>
        function changeMainImage(imageElement) {
            // Get the main image element
            const mainImage = document.getElementById('mainImage');
            // Set its src to the clicked sub-image's src
            mainImage.src = imageElement.src;
        }
    </script>
@endsection
