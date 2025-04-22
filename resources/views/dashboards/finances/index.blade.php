@extends('layouts.app')
@section('title')
    {{ __('لوحة التحكم') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/icons.min.css') }}" rel="stylesheet">

    <style>
        .transport-container-company .card {
            border: none !important;
        }

        .transport-container-company .card:hover {
            scale: 1.1;
            transition: all 0.5s ease-in-out;
        }
    </style>
@endsection
@section('content')
    <br><br>
    <!-- finance section -->
    <div class="container transport-container-company">
        <h1 class="text-center my-5">حالـــــــة طلبات التمويل</h1>
        <div class="row justify-content-center mx-auto ">

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">الطلبات تحت الدراسة</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                        data-target="{{ $underReviewCount }}">{{ $underReviewCount }}</span></h4>
                                <a href="{{ route('dashboard.finance_orders', ['status' => 'under_review']) }}"
                                    class="btn btn-outline-info">عرض جميع
                                    الطلبات</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded fs-3 px-2 py-1">
                                    <i class="fa-solid fa-bag-shopping text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end card -->
            </div>
            <!-- end col -->

            <!-- card -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">الطلبات المكتملة</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                        data-target="{{ $completedCount }}">{{ $completedCount }}</span></h4>
                                <a href="{{ route('dashboard.finance_orders', ['status' => 'completed']) }}"
                                    class="btn btn-outline-success">عرض جميع
                                    الطلبات</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded fs-3 px-2 py-1">
                                    <i class="fa-solid fa-lock text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">الطلبات المرفوضة</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                        data-target="{{ $rejectedCount }}">{{ $rejectedCount }}</span></h4>
                                <a href="{{ route('dashboard.finance_orders', ['status' => 'rejected']) }}"
                                    class="btn btn-outline-danger">عرض جميع
                                    الطلبات</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-danger-subtle rounded fs-3 px-2 py-1">
                                    <i class="fa-solid fa-lock text-danger"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">الطلبات المقبولة</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                        data-target="{{ $acceptedCount }}">{{ $acceptedCount }}</span></h4>
                                <a href="{{ route('dashboard.finance_orders', ['status' => 'accepted']) }}"
                                    class="btn btn-outline-primary">عرض جميع
                                    الطلبات</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded fs-3 px-2 py-1">
                                    <i class="fa-solid fa-lock text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row-->

    </div>
    <br><br>
    <br><br>
    <br><br>
@endsection

@section('script')
@endsection
