@extends('layouts.app')
@section('title')
    {{ __('الصفحة الرئيسية') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/home.css') }}" rel="stylesheet">
    <style>
        .login-title {
            font-family: Almarai;
            font-size: 40px;
            font-weight: 400;
            line-height: 56px;
            text-align: center;
        }

        .last-radio {
            width: 100%;
            text-align-last: center;
        }

        .last-radio input {
            float: none !important;
            position: relative;
            right: 70px;
        }

        .btn-login {
            background: linear-gradient(90deg, #5F5F91 0%, #54B6B7 100%);
            border: 0;
            width: 100%;
            color: white;
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
            height: 40px;
        }

        .btn-login:hover {
            color: white;
        }

        .register-link {
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: center;
            color: #1E1E1E;
            text-decoration: none;
            width: 100%;
            float: inline-end;
        }

        .form-label {
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: right;
        }

        .form-check-input {
            font-family: Almarai;
            font-size: 15px;
            font-weight: 400;
            line-height: 22px;
        }

        .login-bg {
            background-image: url('img/login-bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-blend-mode: multiply;
            background-color: #6d5ba7;
            border-radius: 10px;
        }

        .login-sidetitle {
            font-family: Almarai;
            font-size: 32px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: center;
            color: white;
            margin-top: 160px !important;
        }

        .login-subtitle {
            font-family: Almarai;
            font-size: 32px;
            font-weight: 400;
            line-height: 22.4px;
            text-align: center;
            color: white;
        }

        .btn-joing {
            font-family: Almarai;
            font-size: 16px;
            font-weight: 400;
            line-height: 16px;
            text-align: center;
            color: #61528B;
            background-color: #fff;
            width: 292px;
            height: 40px;
            padding: 12px;
            border-radius: 8px;
            position: relative;
            right: 110px;
            top: 10px;
        }

        .btn-joing:hover {
            color: #61528B;
            background-color: #fff;
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 100%;
                margin: 1.75rem auto;
            }
        }

        .modal-dialog {
            width: 70%;
            margin: 1.75rem auto;
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
                <h2 class=" mb-4">عرض الكل</h2>
            </div>
            <div class="scroll-container d-flex " id="scrollContainerConsltant">
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">الأستاذ/ ناصر نعمان</h5>
                            <p class="card-text text-muted"> اللغات، التواصل بين الثقافات</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>جامعة الملك
                                    عبدالعزيز
                                </p>
                                <a href="#">
                                    <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                        <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                        <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">الأستاذ/ ناصر نعمان</h5>
                            <p class="card-text text-muted"> اللغات، التواصل بين الثقافات</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>جامعة الملك
                                    عبدالعزيز
                                </p>
                                <a href="#">
                                    <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                        <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                        <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">الأستاذ/ ناصر نعمان</h5>
                            <p class="card-text text-muted"> اللغات، التواصل بين الثقافات</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>جامعة الملك
                                    عبدالعزيز
                                </p>
                                <a href="#">
                                    <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                        <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                        <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">الأستاذ/ ناصر نعمان</h5>
                            <p class="card-text text-muted"> اللغات، التواصل بين الثقافات</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>جامعة الملك
                                    عبدالعزيز
                                </p>
                                <a href="#">
                                    <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                        <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                        <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top"
                            alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">الأستاذ/ ناصر نعمان</h5>
                            <p class="card-text text-muted"> اللغات، التواصل بين الثقافات</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>جامعة الملك
                                    عبدالعزيز
                                </p>
                                <a href="#">
                                    <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                        <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                        <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top"
                            alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">الأستاذ/ ناصر نعمان</h5>
                            <p class="card-text text-muted"> اللغات، التواصل بين الثقافات</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>جامعة الملك
                                    عبدالعزيز
                                </p>
                                <a href="#">
                                    <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                        <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                        <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <img src="{{ asset('build/assets/images/consultant-05.png') }}" class="card-img-top"
                            alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">الأستاذ/ ناصر نعمان</h5>
                            <p class="card-text text-muted"> اللغات، التواصل بين الثقافات</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>جامعة الملك
                                    عبدالعزيز
                                </p>
                                <a href="#">
                                    <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                        <p class="p-0 m-0 text-secondary py-1">تفاصيل</p>
                                        <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- rooms section -->
    <section class="rooms-section my-5">
        <div class="container my-5 ">
            <div class="rooms-titles d-flex justify-content-between mb-3">
                <h2 class=" mb-4">عروض السكن الجامعي</h2>
                <h2 class=" mb-4">عرض الكل</h2>
            </div>
            <div class="scroll-container d-flex " id="scrollContainer">
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <span class="price-badge">20 ريال</span>
                        <img src="{{ asset('build/assets/images/bad2.jpg') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">غرف طلابي</h5>
                            <p class="card-text text-muted">غرف مريحة ومجهزة بكل ما تحتاجه</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن 1
                                    كيلو
                                </p>
                                <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                    <p class="p-0 m-0 text-secondary py-1">حجز</p>
                                    <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <span class="price-badge">20 ريال</span>
                        <img src="{{ asset('build/assets/images/bad2.jpg') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">غرف طلابي</h5>
                            <p class="card-text text-muted">غرف مريحة ومجهزة بكل ما تحتاجه</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن 1
                                    كيلو
                                </p>
                                <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                    <p class="p-0 m-0 text-secondary py-1">حجز</p>
                                    <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <span class="price-badge">20 ريال</span>
                        <img src="{{ asset('build/assets/images/bad2.jpg') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">غرف طلابي</h5>
                            <p class="card-text text-muted">غرف مريحة ومجهزة بكل ما تحتاجه</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن 1
                                    كيلو
                                </p>
                                <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                    <p class="p-0 m-0 text-secondary py-1">حجز</p>
                                    <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <span class="price-badge">20 ريال</span>
                        <img src="{{ asset('build/assets/images/bad2.jpg ') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">غرف طلابي</h5>
                            <p class="card-text text-muted">غرف مريحة ومجهزة بكل ما تحتاجه</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن 1
                                    كيلو
                                </p>
                                <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                    <p class="p-0 m-0 text-secondary py-1">حجز</p>
                                    <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <span class="price-badge">20 ريال</span>
                        <img src="{{ asset('build/assets/images/bad2.jpg') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">غرف طلابي</h5>
                            <p class="card-text text-muted">غرف مريحة ومجهزة بكل ما تحتاجه</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن 1
                                    كيلو
                                </p>
                                <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                    <p class="p-0 m-0 text-secondary py-1">حجز</p>
                                    <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <span class="price-badge">20 ريال</span>
                        <img src="{{ asset('build/assets/images/bad2.jpg ') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">غرف طلابي</h5>
                            <p class="card-text text-muted">غرف مريحة ومجهزة بكل ما تحتاجه</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن 1
                                    كيلو
                                </p>
                                <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                    <p class="p-0 m-0 text-secondary py-1">حجز</p>
                                    <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 " v-for="room in rooms" :key="room.id">
                    <div class="card position-relative shadow">
                        <span class="price-badge">20 ريال</span>
                        <img src="{{ asset('build/assets/images/bad2.jpg') }}" class="card-img-top" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">غرف طلابي</h5>
                            <p class="card-text text-muted">غرف مريحة ومجهزة بكل ما تحتاجه</p>
                            <p class="text-warning">
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                                <i class="fas fa-star ms-2"></i>
                            </p>
                            <div class="container-card-footer d-flex justify-content-between ">
                                <p class="text-muted mb-0 pt-1"><i class="fas fa-map-marker-alt ms-1"></i>يبعد عن 1
                                    كيلو
                                </p>
                                <div class="d-flex justify-content-between  border px-3 rounded-pill">
                                    <p class="p-0 m-0 text-secondary py-1">حجز</p>
                                    <i class="fa-regular fa-newspaper me-3 text-center  py-2 m-0  "></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- company section -->
    <section class="rooms-section my-5 company-section">
        <div class="container my-5 ">
            <div class="rooms-titles d-flex justify-content-between mb-3">
                <h2 class=" mb-4">شــركات التمويل المالي </h2>
                <h2 class=" mb-4">عرض الكل</h2>
            </div>
            <div class="scroll-container d-flex " id="scrollContainerCompany">
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
                <div class="col-md-2 ms-3" v-for="room in rooms" :key="room.id">
                    <div class="card border ">
                        <img src="{{ asset('build/assets/images/ab.jpg') }}" class="card-img-top " alt="no image">
                    </div>
                    <div style="width: 100%; box-sizing: border-box; padding: 10px;">
                        <p class="">شركة الراجحي للتمويل</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- login modal -->
    <div class="modal modal-md " tabindex="-1" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="row pe-3 ps-3">
                        <div class="col-6 mt-3 pb-5">
                            <p class="login-title text-center">تسجيل دخول</p>
                            <div class="mb-4">
                                <label for="type" class="form-label">البريد الالكتروني</label>
                                <input type="text" class="form-control" placeholder="example@demo.com">
                            </div>
                            <div class="mb-4">
                                <label for="type" class="form-label">كلمة المرور</label>
                                <input type="text" class="form-control" placeholder="*****************">
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">النقل</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio2" value="option1">
                                <label class="form-check-label" for="inlineRadio2">السكن</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio3" value="option1">
                                <label class="form-check-label" for="inlineRadio3">التمويل</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio4" value="option1">
                                <label class="form-check-label" for="inlineRadio4">الطلاب</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio5" value="option1">
                                <label class="form-check-label" for="inlineRadio5">الويب ماستر</label>
                            </div>
                            <div class="form-check form-check-inline mt-3 last-radio">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                    id="inlineRadio6" value="option1">
                                <label class="form-check-label" for="inlineRadio6">المستشار</label>
                            </div>
                            <button class="btn btn-login mt-3">تسجيل دخول</button>
                            <a href="javascript:void(0);" class="register-link mt-4">استعادة كلمة السر</a>
                            <a href="javascript:void(0);" class="register-link mt-4">إنشاء حساب جديد (للطلاب فقط)</a>
                        </div>
                        <div class="col-6 pb-5 login-bg">
                            <p class="mt-5 pt-5 login-sidetitle">الشركات - المستشـــــارين</p>
                            <p class="mt-5 pt-5 login-subtitle">ابـــدأوا تجربتكم المميزة معنـا</p>
                            <button class="btn btn-joing mt-5">انضـــــــم الآن</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
@endsection
