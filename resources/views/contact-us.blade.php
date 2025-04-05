@extends('layouts.app')
@section('title')
    {{ __('4uSuccess') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- contact us -->
    <section class="container mt-5 mb-5 contact-section">
        <div class="container">
            <div class="card" style="width: 60%; ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 text-center">
                            <p class="contact-us-header">تواصــــل معنا</p>
                            <input type="text" class="form-control contact-input mt-3" placeholder="الاسم">
                            <input type="text" class="form-control contact-input mt-5"
                                placeholder="البـــــريد الالكتروني">
                            <textarea class="form-control contact-textarea mt-5" placeholder="ادخل الرسالــــــــة"></textarea>
                            <button class="btn btn-contact-submit mt-5">ارسـال</button>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 text-center align-content-center m-md-t-5">
                            <img src="{{  asset('build/assets/images/footer.png ') }}" alt="img" class="contact-logo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
