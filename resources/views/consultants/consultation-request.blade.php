@extends('layouts.app')
@section('title')
    {{ __('طلب استشارة') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/or.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- consultation request section -->
    <section class="container justify-items-center">
        <div class="card mt-5 mb-5">
            <div class="card-body">
                <p class="text-center mb-4 title">إرسال طلب استشارة</p>
                <form>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="type" class="form-label">التخصص</label>
                                <select name="type" class="form-select">
                                    <option disabled selected>اختار التخصص</option>
                                    <option>الذكاء الاصطناعي</option>
                                    <option>إدارة الاعمال</option>
                                    <option>التربية الادبية</option>
                                    <option>علوم الحاسب</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="type" class="form-label">الجنس</label>
                                <select name="type" class="form-select">
                                    <option hidden disabled selected>حدد الجنس</option>
                                    <option>ذكر</option>
                                    <option>أثنى</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="type" class="form-label">اسم المستشار</label>
                                <select name="type" class="form-select">
                                    <option hidden disabled selected>اختار المستشار</option>
                                    <option>الاستاذ/ ناصر نعمان</option>
                                    <option>الاستاذ/ عبدالمجيد علي</option>
                                    <option>الاستاذ/ يحيى خالد</option>
                                    <option>الاستاذ/ وجد أحمد</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="type" class="form-label">نوع الاستشاره</label>
                                <select name="type" class="form-select">
                                    <option>استشاره علمية</option>
                                    <option>استشاره أدابية</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="type" class="form-label">موضوع الإستشاره</label>
                                <input type="text" class="form-control" placeholder="اكتب موضوع الإستشاره">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label for="type" class="form-label">نص الطلب</label>
                                <input type="text" class="form-control" placeholder="أكتب نص طلبك الى المستشار">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">إرسال</button>
                </form>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script src="{{ asset('build/assets/js/chat.js') }}"></script>
@endsection
