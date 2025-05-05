@extends('layouts.app')
@section('title')
    {{ __('صفحة الزائر') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/homee.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    {{-- header --}}
    @include('layouts.header')
    <!-- services -->
    <section class="mt-5 services">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-xl-center service-title">
                    <h2>خدماتنا</h2>
                    <p>يتم عرض جميع الخدماتنا المتوفره على منصة 4uSuccess</p>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <!-- الصندوق الأول -->
                        <div class="swiper-slide">
                            <div class="service-item">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('build/assets/images/transpot.jpg') }}"
                                        alt="">
                                </div>
                                <div class="p-4 text-center border border-5 border-light border-top-0">
                                    <h4 class="mb-3">خدمــة النقل</h4>
                                    <p>سيتمكن الطلاب من طلب وسيلة نقل من وإلى ، مع إمكانية اختيار الوقت والمكان .</p>
                                    <a class="fw-medium" href="#" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">الدخــول للخدمة</a>
                                </div>
                            </div>
                        </div>
                        <!-- الصندوق الثاني -->
                        <div class="swiper-slide">
                            <div class="service-item">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('build/assets/images/housing.jpg') }}"
                                        alt="">
                                </div>
                                <div class="p-4 text-center border border-5 border-light border-top-0">
                                    <h4 class="mb-3">خدمــة السكن</h4>
                                    <p>سيتمكن الطلاب من طلب سكن من وإلى الجامعة، مع إمكانية اختيار المكان.</p>
                                    <a class="fw-medium" href="#" data-bs-toggle="modal"
                                    data-bs-target="#loginModal"> الدخـول للخدمة</a>
                                </div>
                            </div>
                        </div>
                        <!-- الصندوق الثالث -->
                        <div class="swiper-slide">
                            <div class="service-item">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('build/assets/images/conss.jpg') }}"
                                        alt="">
                                </div>
                                <div class="p-4 text-center border border-5 border-light border-top-0">
                                    <h4 class="mb-3">خدمــة الاستشارة</h4>
                                    <p>سيتمكن الطلاب من التواصل مع مستشارين أكاديميين للحصول على الإرشاد المناسب.
                                    </p>
                                    <a class="fw-medium" href="#" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">الدخول للخدمة</a>
                                </div>
                            </div>
                        </div>
                        <!-- الصندوق الرابع -->
                        <div class="swiper-slide">
                            <div class="service-item">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="{{ asset('build/assets/images/fin.jpg') }}" alt="">
                                </div>
                                <div class="p-4 text-center border border-5 border-light border-top-0">
                                    <h4 class="mb-3">خدمــة التمويل</h4>
                                    <p>سيتمكن الطلاب من البحث عن المنح الدراسية والقروض التعليمية المتاحة.</p>
                                    <a class="fw-medium" href="#" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">الدخول للخدمــة</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- النقاط -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>




    </section>

    <!-- services -->
    <section class="my-5 goals">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-xl-center service-title">
                    <h2>أهدافنــــــا</h2>
                    <p>التعليم هو المفتاح للنجاح</p>
                </div>
                <div class="container-v">
                    <div class="card-V">
                        <div class="icon">
                            <img src="{{ asset('build/assets/images/11.png') }}" alt="خدمة النقل">
                        </div>
                        <div class="title-V">تمكين الطلاب في رحلتهم الأكاديمية
                        </div>
                        <div class="overlay-V">
                            <div class="title-V">تمكين الطلاب في رحلتهم الأكاديمية</div>
                            <p>مساعدة الطلاب في اختيار تخصصاتهم وتطوير خططهم الدراسية والمهنية بما يتناسب مع أهدافهم
                                واحتياجاتهم الفردية.</p>
                            <!-- <a href="#" class="button-V">الدخول للخدمة</a>-->
                        </div>
                    </div>
                    <div class="card-V">
                        <div class="icon">
                            <img src="{{ asset('build/assets/images/12.png') }}" alt="خدمة النقل">
                        </div>
                        <div class="title-V">تسهيل حياة الطلاب اليومية </div>
                        <div class="overlay-V">
                            <div class="title-V">تسهيل حياة الطلاب اليومية </div>
                            <p>توفير خدمات متكاملة مثل السكن والنقل والمساعدات المالية لتسهيل حياة الطلاب الجامعية
                                وتخفيف التحديات التي قد يواجهونها.

                            </p>
                            <!-- <a href="#" class="button-V">الدخول للخدمة</a>-->
                        </div>
                    </div>
                    <div class="card-V">
                        <div class="icon">
                            <img src="{{ asset('build/assets/images/13.png') }}" alt="خدمة النقل">
                        </div>
                        <div class="title-V">دعم النجاح الأكاديمي والمهني </div>
                        <div class="overlay-V">
                            <div class="title-V">دعم النجاح الأكاديمي والمهني
                            </div>
                            <p>تقديم استشارات وإرشادات مهنية لمساعدة الطلاب في تطوير مهاراتهم الأكاديمية والشخصية لتحقيق
                                التفوق في مجالاتهم الدراسية والمهنية.
                            </p>
                            <!-- <a href="#" class="button-V">الدخول للخدمة</a>-->
                        </div>
                    </div>
                    <div class="card-V">
                        <div class="icon">
                            <img src="{{ asset('build/assets/images/14.png') }}" alt="خدمة النقل">
                        </div>
                        <div class="title-V">توفير بيئة تواصل مجتمعي فعّالة
                        </div>
                        <div class="overlay-V">
                            <div class="title-V">توفير بيئة تواصل مجتمعي فعّالة
                            </div>
                            <p>خلق مجتمع طلابي تفاعلي يمكّن الطلاب من تبادل الخبرات والمعارف وبناء علاقات داعمة مع
                                زملائهم.

                            </p>
                            <!-- <a href="#" class="button-V">الدخول للخدمة</a>-->
                        </div>
                    </div>
                    <div class="card-V">
                        <div class="icon">
                            <img src="{{ asset('build/assets/images/15.png') }}" alt="خدمة النقل">
                        </div>
                        <div class="title-V">ربط الطلاب بالشركات والخدمات </div>
                        <div class="overlay-V">
                            <div class="title-V">ربط الطلاب بالشركات والخدمات
                            </div>
                            <p>تعزيز التواصل بين الطلاب والشركات التي تقدم خدمات ملائمة لاحتياجاتهم، مثل السكن والنقل
                                والدورات التدريبية، مما يسهل عليهم الوصول إلى الحلول التي يحتاجونها.

                            </p>
                            <!-- <a href="#" class="button-V">الدخول للخدمة</a>-->
                        </div>
                    </div>
                    <div class="card-V">
                        <div class="icon">
                            <img src="{{ asset('build/assets/images/16.png') }}" alt="خدمة النقل">
                        </div>
                        <div class="title-V">تقديم حلول تمويلية مستدامة
                        </div>
                        <div class="overlay-V">
                            <div class="title-V">تقديم حلول تمويلية مستدامة
                            </div>
                            <p>مساعدة الطلاب في الحصول على منح دراسية أو قروض تعليمية، مما يساهم في تقليل الأعباء
                                المالية وتسهيل الوصول إلى التعليم.

                            </p>
                            <!-- <a href="#" class="button-V">الدخول للخدمة</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- js -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cards = document.querySelectorAll(".card-V");

            function checkScroll() {
                const triggerBottom = window.innerHeight * 0.85;
                cards.forEach(card => {
                    const cardTop = card.getBoundingClientRect().top;
                    if (cardTop < triggerBottom) {
                        card.classList.add("show");
                    }
                });
            }
            window.addEventListener("scroll", checkScroll);
            checkScroll();
        });
    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1, // يظهر عنصر واحد في كل مرة
            spaceBetween: 20, // المسافة بين البوكسات
            loop: true, // يجعل السلايدر يستمر بشكل دائري
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 3000, // التبديل كل 3 ثوانٍ
                disableOnInteraction: false, // يبقى شغال حتى لو لمس المستخدم الشاشة
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                }, // على الشاشات المتوسطة يعرض 2 معًا
                1024: {
                    slidesPerView: 3
                }, // على الشاشات الكبيرة يعرض 3 معًا
            },
        });
    </script>
@endsection
