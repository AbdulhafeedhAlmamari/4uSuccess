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
    <!-- houses section -->
    <div class="container transport-container-company">
        <h1 class="text-center my-5">عروض السكن</h1>
        <div class="row justify-content-center mx-auto ">

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">الطلبات الحالية</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                        data-target="{{ $pendingOrdersCount }}">{{ $pendingOrdersCount }}</span></h4>
                                <a href="{{ route('dashboard.house_orders', ['status' => 'pending']) }}" class="btn btn-outline-info">عرض جميع
                                    الطلبات</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded fs-3  px-2 py-1">
                                    <i class="fa-solid fa-bag-shopping text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">الطلبات السابقة</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $confirmedOrdersCount }}</h4>
                                <a href="{{ route('dashboard.house_orders', ['status' => 'confirmed']) }}" class="btn btn-outline-success">عرض جميع
                                    الطلبات</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded fs-3   px-2 py-1">
                                    <i class="fa-solid fa-bag-shopping text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let rows = document.querySelectorAll("table tbody tr");

            rows.forEach(row => {
                row.addEventListener("mouseenter", function() {
                    this.style.transform = "scale(1.02)"; // تكبير بسيط عند التمرير
                    this.style.transition = "transform 0.3s ease-in-out";
                    this.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.1)"; // ظل خفيف
                });

                row.addEventListener("mouseleave", function() {
                    this.style.transform = "scale(1)"; // يرجع للحجم الطبيعي عند خروج الماوس
                    this.style.boxShadow = "none";
                });
            });
        });
    </script>
@endsection
