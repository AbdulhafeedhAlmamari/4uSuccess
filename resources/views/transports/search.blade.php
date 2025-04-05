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
        <form action="{{ route('home.transport.search_result') }}">
            <div class="search-container">
                <h2 class="text-center fw-bold mb-5">بحث النقل الجماعي</h2>
                <div class="btn-group toggle-buttons d-flex mt-3" role="group">
                    <button type="button" class="btn   active" data-toggle="oneWay">ذهاب فقط</button>
                    <button type="button" class="btn " data-toggle="roundTrip">ذهاب وعودة</button>
                </div>
                <div class="mt-3">
                    <label class="form-label">محطة المغادرة</label>
                    <div class="input-group">
                        <span class="input-group-text">📍</span>
                        <input type="text" class="form-control" placeholder="محطة المغادرة ( جدة )">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">محطة الوصول</label>
                    <div class="input-group">
                        <span class="input-group-text">📍</span>
                        <input type="text" class="form-control"
                            placeholder="محطة الوصول ( مكة المكرمة - جامعة أم القرى )">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">موعد المغادرة</label>
                    <div class="input-group">
                        <span class="input-group-text">📅</span>
                        <input type="date" class="form-control" value="2024-10-30">
                    </div>
                </div>
                <div class="mt-3 d-none" id="returnDateContainer">
                    <label class="form-label">موعد العودة</label>
                    <div class="input-group">
                        <span class="input-group-text">📅</span>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">المقاعد</label>
                    <div class="input-group">
                        <span class="input-group-text">👤</span>
                        <input type="number" class="form-control" placeholder="0 مقعد" min="1">
                    </div>
                </div>
                <button class="btn btn-purple mt-4" id="searchButton">بحث</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.toggle-buttons .btn').click(function() {
                // Remove active class from all buttons and add to clicked button
                $('.toggle-buttons .btn').removeClass('active');
                $(this).addClass('active');

                // Toggle return date input visibility
                if ($(this).data('toggle') === 'roundTrip') {
                    $('#returnDateContainer').removeClass('d-none');
                } else {
                    $('#returnDateContainer').addClass('d-none');
                }
            });
        });
    </script>
@endsection
