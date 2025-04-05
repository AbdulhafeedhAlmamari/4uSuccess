@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل النقل') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/transport.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- transports section -->
    <div class="container transport-result-container">
        <h2 class="text-center fw-bold mb-4">نتائج البحث</h2>

        <div class="row result-card align-items-center">
            <div class="col-md-6 trip-details">
                <div class="trip-info">
                    <span>السعر: 50 ر.س</span> <span>المقاعد: 1 مقعد</span>
                    <span> رقم اللوحة: 32654</span>
                    <span class="badge">ذهاب</span>
                </div>
                <div class="timeline mt-2">
                    <span>أم القرى<br>05:20</span>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <span>المدينة<br>04:30</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span>23 ديسمبر 2024</span>
                </div>
                <div class="mt-2">
                    <i class="fa-solid fa-van-shuttle"></i> <span>المسافة: 20 كم</span> | <span>45 د</span>
                </div>
                <div class="d-flex mt-3">
                    <button class="btn-book">حجز الآن</button>
                    <a href="#" class="btn-more ms-2" data-bs-toggle="modal" data-bs-target="#tripModal"><i
                            class="fa-solid fa-ellipsis"></i></a>
                </div>
            </div>
            <div class="col-md-4 image-container">
                <img src="{{ asset('build/assets/images/bus1.png') }}" class="img-fluid rounded" alt="حافلة">
            </div>
        </div>
        <div class="row result-card align-items-center">
            <div class="col-md-6 trip-details">
                <div class="trip-info">
                    <span>السعر: 50 ر.س</span> <span>المقاعد: 1 مقعد</span>
                    <span> رقم اللوحة: 32654</span>
                    <span class="badge">ذهاب</span>
                </div>
                <div class="timeline mt-2">
                    <span>أم القرى<br>05:20</span>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <span>المدينة<br>04:30</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span>23 ديسمبر 2024</span>
                </div>
                <div class="mt-2">
                    <i class="fa-solid fa-van-shuttle"></i> <span>المسافة: 20 كم</span> | <span>45 د</span>
                </div>
                <div class="d-flex mt-3">
                    <button class="btn-book">حجز الآن</button>
                    <a href="#" class="btn-more ms-2" data-bs-toggle="modal" data-bs-target="#tripModal"><i
                            class="fa-solid fa-ellipsis"></i></a>
                </div>
            </div>
            <div class="col-md-4 image-container">
                <img src="{{ asset('build/assets/images/Property 1=2.png') }}" class="img-fluid rounded" alt="حافلة">
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade transport-result-container-modal " id="tripModal" tabindex="-1" aria-labelledby="tripModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="w-25 ms-auto"></div>
                    <h5 class="modal-title ms-2" id="tripModalLabel">تفاصيل الحجز</h5>
                    <button type="button" class="btn-close  m-0" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">اسم السائق</label>
                        <input type="text" class="form-control" value="سالم الروقي" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">عدد الركاب</label>
                        <input type="text" class="form-control" value="10" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">موعد الانطلاق</label>
                        <input type="text" class="form-control" value="05:20" readonly>
                    </div>
                    <p class="text-danger text-center">ينصح بالحضور قبل 15 دقيقة من موعد الانطلاق لضمان إتمام إجراءات
                        الصعود.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
