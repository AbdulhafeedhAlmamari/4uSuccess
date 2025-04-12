@extends('layouts.app')
@section('title')
    {{ __('الصفحة الرئيسية') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/home.css') }}" rel="stylesheet">
    
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

@endsection

@section('script')
    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
@endsection
