@extends('layouts.app')
@section('title')
    {{ __('4uSuccess') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/aboutt.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('build/assets/css/bootstrp.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('build/assets/css/aa.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/home2.css') }}" rel="stylesheet">

    <style>
        .vision-message:hover {
            scale: 1.05;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: all 0.5s ease-in-out;
        }
    </style>
@endsection
@section('content')
    <!-- about us -->

    <div class="position-relative">
        <img class="end--10px position-absolute top-200px z-index-1070 w-sm-70px"
            src="{{ asset('images/about-image.jpg') }}" />
        <img class="d-md-block d-none position-absolute start--10px top-100px z-index-1070"
            src="{{ asset('images/about-image.jpg') }}" />
        <img class="bottom-200px position-absolute start--10px w-350px d-none d-md-block"
            src="{{ asset('images/about-image.jpg') }}" />
    </div>
    <section class="about-vision">
        <h2
            class="m-auto position-relative px-10px section-title text-center text-primary-blue w-fit-content z-index-2 mt-5 mb-4">
            منصة 4uSuccess ورؤيـة 2030</h2>
        <div class="container position-relative z-index-1070">
            <div class="d-flex justify-content-center my-5 flex-column flex-md-row">
                <div class="text-center">
                    <div class="about-vision-icon arrow-lg-1">
                        <img src="{{ asset('images/about-image.jpg') }}" class="vector-icon w-sm-70px" />
                    </div>
                    <img src="{{ asset('images/about-image.jpg') }}"
                        class="d-block d-md-none w-fit-content m-auto position-relative top--15px" />
                    <p class="fs-18px text-grey-4">توفير بيئة داعمة للطلاب</p>
                </div>

                <img class="d-none d-md-block" src="{{ asset('images/about-image.jpg') }}" />
                <div class="d-flex flex-column text-center">
                    <img src="{{ asset('images/about-image.jpg') }}"
                        class="dashed-line h-18px m-auto w-fit-content d-block d-md-none" />
                    <div class="about-vision-icon arrow-lg-2 m-auto w-fit-content">
                        <img src="{{ asset('images/about-image.jpg') }}" class="dashed-circle w-90px d-block d-md-none" />
                        <img src="{{ asset('images/about-image.jpg') }}" class="p-1 vector-icon w-sm-80px" />
                    </div>
                    <img src="{{ asset('images/about-image.jpg') }}"
                        class="dashed-line-2 d-block d-md-none w-fit-content m-auto" />
                    <p class=" fs-18px text-grey-4">تمكين الشباب وبناء المستقبل</p>
                </div>
                <img class="d-none d-md-block" src="{{ asset('images/about-image.jpg') }}">
                <div class="d-flex flex-column text-center">
                    <img src="{{ asset('images/about-image.jpg') }}"
                        class="dashed-line h-18px m-auto w-fit-content d-block d-md-none" />
                    <div class="about-vision-icon m-auto w-fit-content">
                        <img src="{{ asset('images/about-image.jpg') }}" class="dashed-circle d-block d-md-none w-90px" />
                        <img src="{{ asset('images/about-image.jpg') }}" />
                    </div>
                    <p class="fs-18px text-grey-4">تعزيز الاستدامة والتحول الرقمي</p>
                </div>
            </div>
        </div>
    </section>
    <section class="about-mission bg-body-tertiary pb-60px pt-1">
        <h2
            class="m-auto position-relative px-10px section-title text-center text-primary-blue w-fit-content z-index-2 mt-5 mb-4">
            الرؤية والرسالة
        </h2>
        <div class="m-auto w-75 d-flex flex-wrap justify-content-center mb-4 px-md-4">
            <div class="bg-white col-md-5 col-12 d-block p-4 rounded-10px shadow me-3 text-center mt-4 vision-message">
                <div class="position-relative">
                    <div
                        class="bg-body-tertiary bg-with-img h-50px m-auto rounded-circle w-50px bg-with-img position-relative">
                    </div>
                    <h5 class="mt-10px position-absolute text-primary top-0 w-100">رؤيــة 4uSuccess</h5>
                </div>
                <p class="px-4 text-grey-4 mt-2">
                    أن نصبح المنصة الرائدة في *خدمات النقل، السكن، والتمويل* للطلاب، عبر حلول مبتكرة تسهّل حياتهم
                    اليومية، وتعزز استقرارهم الأكاديمي، بما يتماشى مع أهداف رؤية السعودية 2030 في دعم وتمكين الشباب
                </p>
            </div>
            <div class="bg-white col-md-5 col-12 d-block p-4 rounded-10px shadow text-center mt-4 vision-message">
                <div class="position-relative">
                    <div
                        class="bg-body-tertiary bg-with-img h-50px m-auto rounded-circle w-50px bg-with-img position-relative">
                    </div>
                    <h5 class="mt-10px position-absolute text-primary top-0 w-100">رسالــة 4uSucess</h5>
                </div>
                <p class="px-4 text-grey-4 mt-2">
                    نلتزم بتقديم خدمات موثوقة وفعالة تدعم الطلاب في رحلتهم التعليمية، من خلال حلول ذكية تسهّل
                    تنقلهم، توفر لهم سكنًا آمنًا، وتساعدهم على الوصول إلى خيارات تمويل مناسبة، لضمان بيئة مريحة تدعم
                    نجاحهم </p>
            </div>
        </div>
    </section>
    <section class="about-goals bg-grey">
        <div class="container">
            <h2
                class="m-auto position-relative px-10px section-title text-center text-primary-blue w-fit-content z-index-2 mt-5 mb-4">
                الأهداف
            </h2>
            <div class="row justify-content-center px-md-5 px-2">
                <div class="col-6 col-md-3 mb-3">
                    <div class="about-goals-box align-items-baseline d-flex">
                        <img class="me-1 w-22px" src="{{ asset('images/about-image.jpg') }}" />
                        <div class="">
                            <h5 class="font-bold fs-28px text-primary-blue">توفير </h5>
                            <p class="fs-20px text-grey-4 fs-sm-14px">تقديم خدمات النقل، السكن، والتمويل لتلبية
                                احتياجات الطلاب بسهولة وامان </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="about-goals-box align-items-baseline d-flex">
                        <img class="me-1 w-22px" src="{{ asset('images/about-image.jpg') }}" />
                        <div class="">
                            <h5 class="font-bold fs-28px text-primary-blue">تسهيل</h5>
                            <p class="fs-20px text-grey-4 fs-sm-14px">مساعدة الطلاب على التركيز على دراستهم من خلال
                                خدمات تدعم راحتهم واستقرارهم</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="about-goals-box align-items-baseline d-flex">
                        <img class="me-1 w-22px" src="{{ asset('images/about-image.jpg') }}" />
                        <div class="">
                            <h5 class="font-bold fs-28px text-primary-blue">تمكين </h5>
                            <p class="fs-20px text-grey-4 fs-sm-14px">دعم الشباب بحلول مبتكرة تساعدهم على تحقيق
                                الاستقلالية والاستقرار المالي</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="about-goals-box align-items-baseline d-flex">
                        <img class="me-1 w-22px" src="{{ asset('images/about-image.jpg') }}" />
                        <div class="">
                            <h5 class="font-bold fs-28px text-primary-blue">التحول</h5>
                            <p class="fs-20px text-grey-4 fs-sm-14px">استخدام التكنولوجيا لتقديم خدمات ذكية وسريعة
                                تتماشى مع التطور الرقمي</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="about-goals-box align-items-baseline d-flex">
                        <img class="me-1 w-22px" src="{{ asset('images/about-image.jpg') }}" />
                        <div class="">
                            <h5 class="font-bold fs-28px text-primary-blue">تحسين</h5>
                            <p class="fs-20px text-grey-4 fs-sm-14px">الإسهام في توفير بيئة مناسبة للطلاب تدعم
                                نجاحهم وتواكب رؤية السعودية 2030</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3 mb-3">
                    <div class="about-goals-box align-items-baseline d-flex">
                        <img class="me-1 w-22px" src="{{ asset('images/about-image.jpg') }}" />
                        <div class="">
                            <h5 class="font-bold fs-28px text-primary-blue">توسيع</h5>
                            <p class="fs-20px text-grey-4 fs-sm-14px">التوسع في تقديم حلول إضافية لدعم الطلاب في
                                مختلف جوانب حياتهم الأكاديمية والمهنية</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <section class="about-rakaez bg-body-tertiary pb-60px pt-1">
        <h2
            class="m-auto position-relative px-10px section-title text-center text-primary-blue w-fit-content z-index-2 mt-5 mb-4">
            الركائــــز
        </h2>
        <div class="m-auto w-75 d-flex flex-wrap justify-content-center mb-4 px-md-4">
            <div class="bg-white col-md-3 d-block p-4 rounded-10px shadow me-0 me-md-4 text-center mt-4">
                <div class="position-relative">
                    <div
                        class="bg-body-tertiary bg-with-img h-50px m-auto rounded-circle w-50px bg-with-img position-relative">
                    </div>
                    <h5 class="mt-10px position-absolute text-primary top-0 w-100">الركيزة الأولى</h5>
                </div>
                <p class="px-4 text-grey-4 font-semibold mt-2">
                    الابتكار والتطور
                </p>
            </div>
            <div class="bg-white col-md-3 d-block p-4 rounded-10px shadow me-0 me-md-4 text-center mt-4">
                <div class="position-relative">
                    <div
                        class="bg-body-tertiary bg-with-img h-50px m-auto rounded-circle w-50px bg-with-img position-relative">
                    </div>
                    <h5 class="mt-10px position-absolute text-primary top-0 w-100">الركيزة الثانية</h5>
                </div>
                <p class="px-4 text-grey-4 font-semibold mt-2">
                    الجودة والكفاءة
                </p>
            </div>
            <div class="bg-white col-md-3 d-block p-4 rounded-10px shadow text-center mt-4">
                <div class="position-relative">
                    <div
                        class="bg-body-tertiary bg-with-img h-50px m-auto rounded-circle w-50px bg-with-img position-relative">
                    </div>
                    <h5 class="mt-10px position-absolute text-primary top-0 w-100">الركيزة الثالثة</h5>
                </div>
                <p class="px-4 text-grey-4 font-semibold mt-2">
                    الاستدامة والمسؤولية
                </p>
            </div>
        </div>
    </section>
@endsection
