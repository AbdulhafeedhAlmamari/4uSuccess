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

        @forelse ($trips as $trip)
            <div class="row result-card align-items-center">
                <div class="col-md-6 trip-details">
                    <div class="trip-info">
                        <span>السعر: {{ $trip->price }} ر.س</span> <span>المقاعد:{{ $trip->number_of_seats }}</span>
                        <span> رقم اللوحة: {{ $trip->plate_number }}</span>
                        <span class="badge">{{ $trip->trip_type == 'one way' ? 'ذهاب' : 'ذهاب و عودة' }}</span>
                    </div>
                    <div class="timeline mt-2">
                        <span>{{ Str::Limit($trip->start, 15) }}<br>{{ date('H:i', strtotime($trip->go_date)) }}</span>
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <span>{{ Str::Limit($trip->end, 15) }}<br>{{ date('H:i', strtotime($trip->back_date)) }}</span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <span>{{ date('d-M-Y', strtotime($trip->go_date)) }}</span>
                    </div>
                    <div class="mt-2">
                        <i class="fa-solid fa-van-shuttle"></i> <span>المسافة: {{ $trip->distance }} كم</span>
                    </div>
                    <div class="d-flex mt-3">
                        {{-- form send --}}
                        <form action="{{ route('home.transport.store') }}" method="POST" class="w-100">
                            @csrf

                            <input type="hidden" name="transport_id" value="{{ $trip->id }}">
                            <button type="submit" class="btn-book">حجز الآن</button>
                            <a href="#" class="btn-more ms-2" data-bs-toggle="modal" data-bs-target="#tripModal"><i
                                    class="fa-solid fa-ellipsis"></i></a>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 image-container">
                    @php
                        $defaultImage = $trip->transport_type == 'group' ? 'build/assets/images/bus1.png' : 'build/assets/images/Property 1=2.png';

                        $imagePath = $trip->image ? asset($trip->image) : asset($defaultImage);
                    @endphp
                    @if ($trip->trip_type)
                        <img src="{{ $imagePath }}" class="img-fluid rounded" alt="حافلة">
                    @else
                        <img src="{{ $imagePath }}" class="img-fluid rounded" alt="حافلة">
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade transport-result-container-modal " id="tripModal" tabindex="-1"
                aria-labelledby="tripModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="w-25 ms-auto"></div>
                            <h5 class="modal-title ms-2" id="tripModalLabel">تفاصيل الحجز</h5>
                            <button type="button" class="btn-close  m-0" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">اسم السائق</label>
                                <input type="text" class="form-control" value="{{ $trip->driver_name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">عدد الركاب</label>
                                <input type="text" class="form-control" value="{{ $trip->number_of_seats }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">موعد الانطلاق</label>
                                <input type="text" class="form-control"
                                    value="{{ date('H:i', strtotime($trip->go_date)) }}" readonly>
                            </div>
                            <p class="text-danger text-center">ينصح بالحضور قبل 15 دقيقة من موعد الانطلاق لضمان إتمام
                                إجراءات
                                الصعود.</p>
                        </div>
                    </div>
                </div>
            </div>
            @if ($trips->count() == 1)
                <br><br><br><br>
            @endif
        @empty
            <br><br><br>
            <div class="row result-card align-items-center">
                <div class="col-md-12 text-center">
                    <h4>لا توجد نتائج مطابقة للبحث</h4>
                </div>
            </div>
            <br><br><br><br><br><br><br><br>
        @endforelse
    </div>
@endsection
