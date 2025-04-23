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
    <div class="container transport-search-container">
        <form action="{{ route('home.transport.search.for_trip') }}" method="POST">
            @csrf
            <div class="search-container">
                <h2 class="text-center fw-bold mb-5">بحث النقل الجماعي</h2>
                <div class="btn-group toggle-buttons d-flex mt-3" role="group">
                    <button type="button" class="btn active" data-toggle="oneWay">ذهاب فقط</button>
                    <button type="button" class="btn" data-toggle="round_trip">ذهاب وعودة</button>
                </div>
                <input type="hidden" name="trip_type" id="tripType" value="one_way">
                <div class="mt-3">
                    <label class="form-label">محطة المغادرة</label>
                    <div class="input-group">
                        <span class="input-group-text">📍</span>
                        <input type="text" name="departure_station" class="form-control"
                            placeholder="محطة المغادرة ( جدة )">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">محطة الوصول</label>
                    <div class="input-group">
                        <span class="input-group-text">📍</span>
                        <input type="text" name="arrival_station" class="form-control"
                            placeholder="محطة الوصول ( مكة المكرمة - جامعة أم القرى )">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">موعد المغادرة</label>
                    <div class="input-group">
                        <span class="input-group-text">📅</span>
                        <input type="date" name="departure_date" class="form-control" value="">
                    </div>
                </div>
                <div class="mt-3 d-none" id="returnDateContainer">
                    <label class="form-label">موعد العودة</label>
                    <div class="input-group">
                        <span class="input-group-text">📅</span>
                        <input type="date" name="return_date" class="form-control">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">المقاعد</label>
                    <div class="input-group">
                        <span class="input-group-text">👤</span>
                        <input type="number" name="seats" class="form-control" placeholder="0 مقعد" min="1">
                    </div>
                </div>
                <button type="submit" class="btn btn-purple mt-4" id="searchButton">بحث</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.toggle-buttons .btn').click(function() {
                $('.toggle-buttons .btn').removeClass('active');
                $(this).addClass('active');

                let tripType = $(this).data('toggle');
                $('#tripType').val(tripType);

                if (tripType === 'roundTrip') {
                    $('#returnDateContainer').removeClass('d-none');
                } else {
                    $('#returnDateContainer').addClass('d-none');
                }
            });
        });
    </script>
@endsection
