@extends('layouts.app')
@section('title')
    {{ __('طريقة الدفع') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/transport.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-5 transport-payment-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h4 class="mb-4">طريقة الدفع</h4>
                <div class="d-flex justify-content-between  p-2 rounded mb-3">
                    <div class="p-2 rounded mb-3 border w-50 me-3">
                        <input type="radio" name="paymentMethod" id="creditCard" checked>
                        <label for="creditCard">بطاقة إئتمان <img
                                src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png"
                                width="30"></label>
                    </div>
                    <div class="p-2 rounded mb-3 border w-50">
                        <input type="radio" name="paymentMethod" id="paypal">
                        <label for="paypal">باي بال <img
                                src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" width="30"></label>
                    </div>
                </div>

                <h5 class="mb-3">معلومات بطاقة الإئتمان</h5>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="رقم البطاقة" value="" readonly>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="الاسم" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" placeholder="شهر / سنة" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" placeholder="CVV" value="" required>
                    </div>
                </div>

                <h5 class="mb-3">ملخص الطلب</h5>
                <ul class="list-group mb-3 ">
                    <li class="list-group-item d-flex justify-content-between">التكلفة <span>50.00 ريال</span></li>
                    <li class="list-group-item d-flex justify-content-between">الضريبة <span>15%</span></li>
                    <li class="list-group-item d-flex justify-content-between">رسوم الخدمة <span>23.00 ريال</span></li>
                    <li class="list-group-item d-flex justify-content-between fw-bold">الإجمالي <span>73 ريال</span>
                    </li>
                </ul>
                <button class="btn btn-gradient w-100 py-2">تأكيد الدفع</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
@endsection
