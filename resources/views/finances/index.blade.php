@extends('layouts.app')
@section('title')
    {{ __('المساكن') }}
@endsection
@section('css')
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/styl.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/all.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- houses section -->

    <main class="main">
        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">

                <p>التمــــــويل المالي </p>
            </div>
            <!-- End Section Title -->

            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">الكل</li>
                        <li data-filter=".filter-app">الجامعات</li>
                        <li data-filter=".filter-product">الشركات</li>
                    </ul>
                    <!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">


                        <!-- End Portfolio Item -->

                        @forelse($financingCompanies as $index => $financingCompany)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <div class="portfolio-content h-100">
                                    <img src="{{ $financingCompany->user->profile_image ? asset($financingCompany->user->profile_image) : asset('images/default.jpeg') }}"
                                        class="img-fluid" alt="">
                                    <div class="portfolio-info">

                                        <p>{{ $financingCompany->user->name }} </p>
                                        <a href="{{ route('home.finances.show', $financingCompany->id) }}"
                                            title="university" class="glightbox preview-link"></a>
                                        <a href="{{ route('home.finances.show', $financingCompany->id) }}"
                                            title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>لا يوجد مؤسسات تمويلية</p>
                        @endforelse

                        <!-- End Portfolio Item -->




                    </div>
                    <!-- End Portfolio Container -->

                </div>

            </div>

        </section>
        <!-- /Portfolio Section -->
        <!-- footer -->




    </main>
@endsection

@section('script')
    <!-- coffee section end -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
