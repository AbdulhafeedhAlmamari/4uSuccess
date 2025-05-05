@extends('layouts.app')
@section('title')
    {{ __('4uSuccess') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #fff;
            direction: rtl;
        }

        .topbar {
            background: linear-gradient(to left, #3e7cc6, #5fadc7);
            color: white;
            padding: 15px;
            text-align: left;
        }

        .topbar a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
        }

        .faq-title {
            /* text-align: center; */
            font-size: 2.5rem;
            margin: 40px 0 20px;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
            color: white;
        }

        .accordion {
            --bs-accordion-border-width: 0px;
        }

        .buttom-order {
            border-radius: 10px;
            border-bottom: 1px solid #61528B;
            margin-bottom: 30px;
        }
        .accordion{
            height: 50vh;
        }
    </style>
@endsection
@section('content')
    <!-- FAQ Section -->
    <div class="container">
        <h2 class="faq-title">الأسئلة الشائعة</h2>

        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                        كيف يمكنني التقديم للحصول على تمويل دراسي؟
                    </button>
                </h2>
                <div id="q1" class="accordion-collapse collapse buttom-order" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        يمكنك التقديم عن طريق الموقع الإلكتروني من خلال تعبئة النموذج وتقديم المستندات المطلوبة.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#q2">
                        ما هي شروط السداد لتمويل القروض؟
                    </button>
                </h2>
                <div id="q2" class="accordion-collapse collapse buttom-order" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        يتم السداد على أقساط شهرية ميسرة تبدأ بعد التخرج بفترة سماح محددة.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q3">
                        هل يمكنني التقديم للحصول على تمويل إضافي إذا لم تُكفِني القرض الأول؟
                    </button>
                </h2>
                <div id="q3" class="accordion-collapse collapse  buttom-order " data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        نعم، يمكنك التقديم للحصول على تمويل إضافي إذا كانت حالتك المالية تتطلب ذلك، بشرط أن تكون قد سددت
                        جزءًا من القرض الأول.
                    </div>
                </div>
            </div>

            <!-- Add more items similarly -->
        </div>
    </div>
@endsection
