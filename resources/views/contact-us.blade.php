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

            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 text-center" data-aos="fade-down"
                        data-aos-easing="linear"
                        data-aos-duration="1500">
                            <p class="contact-us-header">تواصــــل معنا</p>
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <input type="text" name="name" class="form-control contact-input mt-3"
                                    placeholder="الاسم" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <input type="email" name="email" class="form-control contact-input mt-5"
                                    placeholder="البـــــريد الالكتروني" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <textarea name="message" class="form-control contact-textarea mt-5" placeholder="ادخل الرسالــــــــة" required></textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-contact-submit mt-5">ارسـال</button>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 text-center align-content-center m-md-t-5" data-aos="fade-up"
                        data-aos-duration="3000">
                            <img src="{{ asset('build/assets/images/footer.png ') }}" alt="img" class="contact-logo h-50 w-50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
