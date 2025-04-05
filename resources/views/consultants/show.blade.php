@extends('layouts.app')
@section('title')
    {{ __('عرض تفاصيل المستشار') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- consultants section -->

    <section class="container mt-5 consultant-details">
        <div class="card  border-0">
            <div class="row g-0 ">
                <div class="col-md-4 w-25 h-75">
                    <img src="{{ asset('build/assets/images/consultant-05.png') }}" alt="no image" class="img-fluid rounded-3"
                        style="width: 100%; height: 100%;">
                    <div class="w-100 d-flex flex-column justify-content-center align-items-center">
                        <h4 class="fw-bold mt-4">الأستاذ/ وجد أحمد</h4>
                        <p class="text-muted">جامعة الملك عبدالعزيز</p>
                        <button class="btn btn-primary rounded-pill px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#chatModal">دردشة</button>
                    </div>

                </div>
                <div class="col-md-8 p-4">
                    <h2 class="fw-bold text-center text-md-end">تفاصيل المستشار</h2>
                    <p><strong>التخصص:</strong> العلوم الصحية، التغذية</p>
                    <p><strong>الخبرة:</strong> باحث/ة متخصص/ة في مجال التغذية والصحة العامة، مع اهتمام خاص بصحة
                        الطلاب الجامعيين.</p>
                    <p><strong>مجالات الاستشارة:</strong> التغذية السليمة، الحفاظ على الصحة البدنية والنفسية، مكافحة
                        السمنة، بناء عادات صحية مستدامة.</p>
                    <p><strong>رسالة شخصية:</strong> "سأساعدك على اتباع نمط حياة صحي يُعزز طاقتك وتركيزك ويساعدك على
                        تحقيق أهدافك الدراسية."</p>

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
