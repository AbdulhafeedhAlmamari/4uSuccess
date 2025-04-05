@extends('layouts.app')
@section('title')
    {{ __('المساكن') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/house.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- houses section -->
    <section class="houses-section my-5 house-section">
        <div class="container my-5 ">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-6">
                    <p class="houses_header mb-5 h1">السكن الجامعي</p>
                </div>
                <div class="col-6">
                    <form action="">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="بحث عن سكن">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="button-addon2">ابحث</button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <select class="form-select form-select" name="" id="">
                                        <option selected>المسافة</option>
                                        <option value="">مسافة 1</option>
                                        <option value="">مسافة 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <select class="form-select form-select" name="" id="">
                                        <option selected>السعر</option>
                                        <option value="">سعر 1</option>
                                        <option value="">سعر 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row  g-2">
                <div class="col-6">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-12">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="{{ asset('build/assets/images/ho1.jpg') }}"
                                            class="card-img-top h-100 w-100 rounded-start " alt="...">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title">شارع الملك عبد العزيز، حي الجامعة، الرياض 11451</h5>
                                            <p class="card-text">يبعد عنك 5 كيلو</p>
                                            <p class="card-text"><small class="text-muted">500 ريال شهريًا</small></p>
                                            <a href="{{ route('home.houses.show') }}"
                                                class="btn btn-primary form-control w-50">تفاصيل
                                                أكثر</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-12">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="{{ asset('build/assets/images/ho1.jpg') }}"
                                            class="card-img-top h-100 w-100 rounded-start " alt="...">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title">شارع الملك عبد العزيز، حي الجامعة، الرياض 11451</h5>
                                            <p class="card-text">يبعد عنك 5 كيلو</p>
                                            <p class="card-text"><small class="text-muted">500 ريال شهريًا</small></p>
                                            <a href="{{ route('home.houses.show') }}"
                                                class="btn btn-primary form-control w-50">تفاصيل
                                                أكثر</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-12">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="{{ asset('build/assets/images/ho1.jpg') }}"
                                            class="card-img-top h-100 w-100 rounded-start " alt="...">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title">شارع الملك عبد العزيز، حي الجامعة، الرياض 11451</h5>
                                            <p class="card-text">يبعد عنك 5 كيلو</p>
                                            <p class="card-text"><small class="text-muted">500 ريال شهريًا</small></p>
                                            <a href="{{ route('home.houses.show') }}"
                                                class="btn btn-primary form-control w-50">تفاصيل
                                                أكثر</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>
@endsection
