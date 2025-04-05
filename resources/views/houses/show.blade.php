@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل المستشار') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/house.css') }}" rel="stylesheet">
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
                                <div class="col-12 ">
                                    <div class="image-container">
                                        <img src="{{ asset('build/assets/images/ho1.jpg') }}" alt="صورة السكن"
                                            class=" main-image" id="mainImage">
                                    </div>
                                </div>
                                <!-- Carousel Sub Images -->
                                <div id="subImageCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="d-flex justify-content-center">
                                                <img onclick="changeMainImage(this)"
                                                    src="{{ asset('build/assets/images/ho1.jpg') }}" alt="صورة السكن"
                                                    class="mx-2">
                                                <img onclick="changeMainImage(this)"
                                                    src="{{ asset('build/assets/images/ho1.jpg') }}" alt="صورة السكن"
                                                    class="mx-2">
                                                <img onclick="changeMainImage(this)"
                                                    src="{{ asset('build/assets/images/hf1.png') }}" alt="صورة السكن"
                                                    class="mx-2">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="d-flex justify-content-center">
                                                <img onclick="changeMainImage(this)"
                                                    src="{{ asset('build/assets/images/ho1.jpg') }}" alt="صورة السكن"
                                                    class="mx-2">
                                                <img onclick="changeMainImage(this)"
                                                    src="{{ asset('build/assets/images/ho1.jpg') }}" alt="صورة السكن"
                                                    class="mx-2">
                                                <img onclick="changeMainImage(this)"
                                                    src="{{ asset('build/assets/images/ho1.jpg') }}" alt="صورة السكن"
                                                    class="mx-2">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev  " type="button"
                                        data-bs-target="#subImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon  arrow" aria-hidden="true"></span>
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
                                        <li><strong>العنوان:</strong> شارع الملك عبد العزيز، الرياض، الجامعة 11451</li>
                                        <li><strong>المسافة:</strong> يبعد عنك 5 كيلو</li>
                                        <li><strong>السعر:</strong> 500 ريال شهرياً</li>
                                        <li><strong>نوع الغرف:</strong> غرفة فردية، غرفة مزدوجة</li>
                                        <li><strong>المميزات:</strong> مثالي، واي فاي، موقف سيارات، غسيل ملابس، صالة
                                            ألعاب</li>
                                        <li><strong>وصف:</strong> سكن جامعي حديث مع غرف مفروشة بالكامل ومرافق متكاملة.
                                        </li>
                                        <li><strong>القواعد:</strong> مسموح بالزوار حتى الساعة 10 مساءً، الالتزام
                                            بالهدوء بعد منتصف الليل.</li>
                                        <li>
                                            <span><strong>التقييمات:</strong>
                                                <span class="" style="color: #54B6B7;">&#9733; &#9733; &#9733; &#9733;
                                                    &#9734;</span>
                                            </span>
                                        </li>
                                        <li>
                                            <button class="btn form-control w-50">تأكيد الحجز</button>
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
                            <div class="col-3">
                                <img src="{{ asset('build/assets/images/ho1.png') }}" class="img-fluid" alt="صورة إضافية">
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('build/assets/images/ho1.png') }}" class="img-fluid" alt="صورة إضافية">
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('build/assets/images/ho1.png') }}" class="img-fluid" alt="صورة إضافية">
                            </div>
                            <div class="col-3">
                                <img src="{{ asset('build/assets/images/ho1.png') }}" class="img-fluid" alt="صورة إضافية">
                            </div>
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
