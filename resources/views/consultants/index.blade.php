@extends('layouts.app')
@section('title')
    {{ __('عرض المستشارون') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- consultants section -->
    <section class="consultants-section my-5">
        <div class="container my-5 ">
            <p class="consultants_header mb-5">المستشارون</p>
            <form action="">
                <div class="d-flex justify-content-center">
                    <select class="form-select  ms-4 " aria-label="Default select example">
                        <option selected>التخصص</option>
                        <option value="1">الذكاء الاصطناعي</option>
                        <option value="2">إدارة الاعمال</option>
                        <option value="3">التربية الادبية</option>
                        <option value="4">علوم الحاسب</option>
                    </select>
                    <div class="form-check ms-4 mt-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            ذكر
                        </label>
                    </div>
                    <div class="form-check ms-4 mt-2">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            انثى
                        </label>
                    </div>
                    <button class="" type="submit">بحث</button>
                </div>
            </form>

            <div class="container mb-5">
                <div class="row mt-5">
                    <div class="col-lg-3 col-md-4 mt-3">
                        <div class="card border-0 shadow p-2 rounded-3">
                            <img src="{{ asset('build/assets/images/consultant-01.png') }}"
                                class="card-img-top rounded-circle h-25 w-50 m-auto" alt="img">
                            <div class="card-body px-0 m-0">
                                <h5 class="card-title">الأستاذ/ علي احمد</h5>
                                <p class="card-text">هندسة البرمجيات، الذكاء الاصطناعي</p>
                                <div class="row mt-5">
                                    <div class="col-10">
                                        <a href="{{ route('home.consultants.show') }}" class="btn btn-view">عـــــرض الحساب</a>
                                    </div>
                                    <div class="col-2">
                                        <i class="fa-regular fa-comment-dots fs-3" data-bs-toggle="modal"
                                            data-bs-target="#chatModal"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.chat-modal')
@endsection


@section('script')
    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
    <script src="{{ asset('build/assets/js/chat.js') }}"></script>
@endsection
