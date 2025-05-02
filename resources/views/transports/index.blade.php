@extends('layouts.app')
@section('title')
    {{ __('النقل') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/transport.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- transports section -->
    <section>
        <div class="container mt-5 transport-container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card custom-card">
                        <div class="image-container">
                            <img src="{{ asset('build/assets/images/image.png') }}" class="card-img-top" alt="نقل جماعي">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">نقل جماعي</h5>
                            <a href="{{ route('home.transport.show', ['type' => 'group']) }}" class="btn btn-purple">تفاصيل النقل</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card custom-card">
                        <div class="image-container">
                            <img src="{{ asset('build/assets/images/image (1).png') }}" class="card-img-top" alt="نقل فردي">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">نقل فردي</h5><a
                                href="{{ route('home.transport.show', ['type' => 'single']) }}"
                                class="btn btn-purple">تفاصيل النقل</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
