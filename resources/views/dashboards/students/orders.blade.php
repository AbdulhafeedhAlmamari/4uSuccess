@extends('layouts.app')
@section('title')
    {{ __('الطلبات') }}
@endsection
@section('css')
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    {{-- css style --}}
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('build/assets/css/profile.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('build/assets/css/table.css') }}" rel="stylesheet">
    <style>
        /* student profile orders page */
        .rating {
            cursor: pointer;
        }

        .star-container .stars-inactive {
            position: absolute;
            top: 0px;
            /* left: 104px; */
        }

        #housing .star-container {
            width: 40%;
        }

        #consultationTable .star-container {
            /* width: 40%; */
        }

        .stars-inactive {
            /* color: #ccc; */

        }



        .stars-active {
            color: #54B6B7;
            !important;
            position: relative;
            z-index: 10;
            display: block;
            overflow: hidden;
            white-space: nowrap;
        }

        .rating-star {
            font-size: 20px;
            /* color: #ccc; */
            cursor: pointer;
        }

        .rating-star.checked {
            color: #54B6B7;
            ;
        }

        .orders-section .nav {
            padding-bottom: 10px;
            border-bottom: none;
        }

        .orders-section .nav-link {
            font-size: 1.2rem;
            color: #333;
            cursor: pointer;
            position: relative;
            background: none !important;
        }

        .orders-section .nav-link:hover {
            color: #666;
        }

        .orders-section .nav-link.active::after {
            content: '';
            display: block;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .orders-section .table thead {
            background-color: #f8f9fa;
        }

        .orders-section .content-section {
            display: none;
        }

        .orders-section .content-section.active {
            display: block;
        }

        .orders-section .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #333;
        }

        .orders-section .actions a {
            text-decoration: none;
            color: #666;
            transition: color 0.3s;
            margin-right: 10px;
            font-size: 20px;
        }

        .orders-section a:hover {
            color: #61528B;
        }

        /* modal style */

        .orders-section-modal .modal-content {
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .orders-section-modal .modal-header,
        .orders-section-modal .modal-footer {
            border: none;
            background: none;
        }

        .orders-section-modal .modal-body {
            padding: 20px;
        }

        .orders-section-modal .info-section {

            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .orders-section-modal .info-box {
            padding: 10px;
        }

        .orders-section-modal .divider {
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .orders-section-modal .status-box {
            color: #28a745;
            font-weight: bold;
        }

        .orders-section-modal .icon-box {
            width: 15px;
            height: 15px;
            background: #bbb;
            display: inline-block;
            border-radius: 4px;
        }

        .orders-section-modal .image-container {
            display: flex;
            height: 50px;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 10px;
            align-items: center;
        }

        .orders-section-modal .image-container img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 15px;
        }

        /*  */
        .table-title {
            color: #333;
            background-color: #f5f3f4;
            /* padding: 16px 25px;
                                                                                                                                                                                                                                                                                                                                                                                            margin: -20px -25px 10px; */
            border-radius: 3px 3px 0 0;
            direction: ltr;
            align-items: center;
            flex-direction: row-reverse;
            display: flex;
            justify-content: space-between;
        }
    </style>
@endsection
@section('content')
    <br><br>
    <!-- student orders section -->
    <div class="container mt-5 orders-section">
        <nav class="nav nav-pills nav-fill mb-4">
            <a class="nav-link active" data-section="housing" onclick="showSection('housing')"><i
                    class="fas fa-home"></i><br> طلبات السكن</a>
            <a class="nav-link" data-section="transport" onclick="showSection('transport')"><i class="fas fa-car"></i>
                <br> طلبات النقل</a>
            <a class="nav-link" data-section="finance" onclick="showSection('finance')"><i class="fas fa-briefcase"></i>
                <br> طلبات التمويل</a>
            <a class="nav-link" data-section="consult" onclick="showSection('consult')"><i class="fas fa-phone"></i>
                <br> طلبات الاستشارة</a>
        </nav>

        {{-- filepath: e:\myProjects\laravel\laravel_project\4uSuccess\resources\views\dashboards\students\orders.blade.php --}}

        <div id="housing" class="content-section active shadow">
            <div class="table-title d-flex justify-content-between align-items-center">
                <h2 class="p-3">طلبات السكن حالية</h2>
            </div>
            <div class="table-wrapper global-table p-3">
                <div class="table-responsive">
                    <table id="tableID" class="display nowrap consultant-container">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>أسم السكن</th>

                                {{-- <th>الرقم الجامعــي</th> --}}
                                <th>نوع السكن</th>
                                <th>المبلغ</th>
                                <th>حالة الطلب</th>
                                <th>تاريخ الطلب</th>
                                <th>الاجرائات</th>
                            </tr>
                        </thead>
                        {{-- filepath: e:\myProjects\laravel\laravel_project\4uSuccess\resources\views\dashboards\students\orders.blade.php --}}

                        <tbody>
                            @forelse($housingRequests as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ $order->housing->housingCompany->name ?? 'غير متوفر' }}
                                    </td>
                                    <td>{{ $order->housing->housing_type ?? 'غير متوفر' }}</td>
                                    <td>
                                        <div>
                                            {{ $order->housing->price ?? 'غير متوفر' }} ريال</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                                            {{ $order->status == 'pending' ? 'قيد الانتظار' : 'تمت الموافقة' }}
                                        </span>
                                    </td>
                                    <td>{{ $order->request_date }}</td>
                                    <td class="actions d-flex gap-4">
                                        @if ($order->status == 'confirmed')
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#orderModal{{ $order->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a href="{{ route('payment', $order->id) }}">
                                                <i class="fa-brands fa-paypal"></i>
                                            </a>
                                        @elseif ($order->status == 'completed')
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#orderModal{{ $order->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            @if ($order->housing->rate() > 0)
                                                <div class="star-container   position-relative">
                                                    <span class="stars-active"
                                                        style="width:{{ $order->housing->rate() * 20 }}% ">
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                    </span>

                                                    <span class="stars-inactive">
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                        <span> &#9733;</span>
                                                    </span>
                                                </div>
                                            @else
                                                <div class="rating" id="rating-{{ $order->housing->id }}">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span data-value="{{ $i }}"
                                                            onclick="rateHouse({{ $order->housing->id }}, {{ $i }})"
                                                            class="rating-star ">&#9733;</span>
                                                    @endfor
                                                </div>
                                            @endif
                                        @else
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#orderModal{{ $order->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @endif

                                    </td>
                                </tr>

                                <!-- Modal for each order -->
                                <div class="modal fade orders-section-modal" id="orderModal{{ $order->id }}"
                                    tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="info-section">
                                                    <div class="text-start">
                                                        <div class="image-container">
                                                            @if (isset($order->housing->primaryPhoto))
                                                                <img src="{{ asset($order->housing->primaryPhoto->path) ?? asset('img/default-housing.jpg') }}"
                                                                    alt="السكن الجامعي">
                                                            @else
                                                                <img src="{{ asset('images/default.jpeg') }}"
                                                                    alt="السكن الجامعي">
                                                            @endif

                                                            <h5 class="ms-3">
                                                                {{ $order->housing->housingCompany->name ?? 'غير متوفر' }}
                                                            </h5>
                                                        </div>
                                                        <p class="text-muted">
                                                            {{ $order->housing->address ?? 'العنوان غير متوفر' }}<br>
                                                            {{ $order->housing->housingCompany->phone_number ?? 'رقم الهاتف غير متوفر' }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <h5>طلب رقم {{ $order->id }}</h5>
                                                        <p class="text-muted">تاريخ الطلب:
                                                            {{ \Carbon\Carbon::parse($order->request_date)->format('Y-m-d') }}
                                                        </p>
                                                        <p class="status-boxx">حالة الطلب:
                                                            <span
                                                                class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                                                                {{ $order->status == 'pending' ? 'قيد الانتظار' : 'تمت الموافقة' }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="divider"></div>
                                                <div class="row text-start">
                                                    <div class="col-md-4">
                                                        <h6 class="text-muted">طلب سكن</h6>
                                                        <p><strong>الوسيط:</strong> 4SUCCESS</p>
                                                        <p><strong>اسم الطالب:</strong>
                                                            {{ $order->student->name ?? 'غير متوفر' }}</p>
                                                        <p><strong>الرقم الجامعي:</strong>
                                                            {{ $order->student->student_id ?? 'غير متوفر' }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6 class="text-muted">معلومات السكن</h6>
                                                        <p><strong>رقم السكن:</strong>
                                                            {{ $order->housing->id ?? 'غير متوفر' }}</p>
                                                        <p><strong>السعر:</strong>
                                                            {{ $order->housing->price ?? 'غير متوفر' }} ريال</p>
                                                        <p><strong>الموقع:</strong>
                                                            {{ $order->housing->address ?? 'غير متوفر' }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6 class="text-muted">الدفع</h6>
                                                        <p><strong>طريقة الدفع:</strong>
                                                            {{ $order->payment_method ?? 'paypal' }}</p>
                                                        <p><strong>إجمالي المبلغ:</strong>
                                                            {{ $order->housing->price ?? 'غير متوفر' }} ريال</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">لا توجد طلبات سكن حالية</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- transport orders --}}
        <div id="transport" class="content-section">
            <!-- <h2 class="text-center mb-4">طلبات النقل</h2> -->
            <div class="table-responsive">
                <div class="container financing-container global-table">
                    <div class="table-wrapper ">
                        <div class="table-title d-flex justify-content-between align-items-center">
                            <h2 class="m-0">طلبات النقل</h2>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم الشركة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>نقطة الانطلاق</th>
                                    <th>نقطة الوصول</th>
                                    <th>المبلغ</th>
                                    <th>حالة الطلب</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transportationRequests as $index => $transportationRequest)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm ms-2 bg-light rounded p-1">
                                                        <img src="{{ asset($transportationRequest->trip->image ?? 'images/user-logo.svg') }}"
                                                            alt="Product Image" class="img-fluid d-block"
                                                            style="width: 50px; height: 50px;">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-14 mb-1">
                                                        <a href="#" class="text-body">
                                                            {{ $transportationRequest->trip->transportationCompany->name ?? 'غير متوفر' }}
                                                        </a>
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        {{ $transportationRequest->trip->transport_type == 'group' ? 'خدمة نقل جماعي' : 'خدمة نقل فردي' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($transportationRequest->request_date)->format('d M Y') }}
                                        </td>
                                        <td>{{ $transportationRequest->trip->start ?? 'غير متوفر' }}</td>
                                        <td>{{ $transportationRequest->trip->end ?? 'غير متوفر' }}</td>
                                        <td>{{ $transportationRequest->trip->price ?? 'غير متوفر' }} ريال</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $transportationRequest->status == 'pending' ? 'warning' : ($transportationRequest->status == 'rejected' ? 'danger' : ($transportationRequest->status == 'completed' ? 'success' : 'info')) }}">
                                                {{ $transportationRequest->status == 'pending' ? 'قيد الانتظار' : ($transportationRequest->status == 'rejected' ? 'مرفوضة' : ($transportationRequest->status == 'completed' ? 'مكتملة' : 'في انتظار الدفع')) }}
                                            </span>
                                        </td>
                                        <td class="actions">
                                            @if ($transportationRequest->status == 'completed')
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#orderModal{{ $transportationRequest->id }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            @elseif ($transportationRequest->status == 'onRoad')
                                                <a href="{{ route('payment', $transportationRequest->id) }}">
                                                    <i class="fa-brands fa-paypal"></i>
                                                </a>
                                            @else
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#orderModal{{ $transportationRequest->id }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            @endif
                                            @if ($transportationRequest->status == 'paid')
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#orderModal{{ $transportationRequest->id }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>

                                    <!-- Modal for Transportation Details -->
                                    <div class="modal fade orders-section-modal"
                                        id="orderModal{{ $transportationRequest->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="info-section">
                                                        <div>
                                                            <h5>رقم الرحلة:
                                                                <span>{{ $transportationRequest->trip->id ?? '-' }}</span>
                                                                @if (isset($transportationRequest->trip->image))
                                                                    <img src="{{ asset($transportationRequest->trip->image) }}"
                                                                        alt="صورة الرحلة" class="img-fluid rounded ms-2"
                                                                        style="width: 50px; height: 50px;">
                                                                @else
                                                                    <img src="{{ asset('images/default.jpeg') }}"
                                                                        alt="صورة الرحلة" class="img-fluid rounded ms-2"
                                                                        style="width: 50px; height: 50px;">
                                                                @endif

                                                            </h5>
                                                            <p class="text-muted">اسم السائق:
                                                                <span>{{ $transportationRequest->trip->driver_name ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">رقم اللوحة:
                                                                <span>{{ $transportationRequest->trip->plate_number ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">الوجهة:
                                                                <span>{{ $transportationRequest->trip->destination ?? '-' }}</span>
                                                            </p>
                                                            <p class="status-box">نوع النقل:
                                                                <span>{{ $transportationRequest->trip->transport_type == 'group' ? 'جماعي' : 'فردي' }}</span>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <h5>رقم الطلب: <span>{{ $transportationRequest->id }}</span>
                                                            </h5>
                                                            <p class="text-muted">تاريخ الطلب:
                                                                {{ \Carbon\Carbon::parse($transportationRequest->request_date)->format('Y-m-d') }}
                                                            </p>
                                                            <p class="text-muted">حالة الطلب:
                                                                <span
                                                                    class="badge bg-{{ $transportationRequest->status == 'completed' ? 'success' : ($transportationRequest->status == 'rejected' ? 'danger' : 'warning') }}">
                                                                    {{ $transportationRequest->status == 'completed' ? 'مكتملة' : ($transportationRequest->status == 'rejected' ? 'مرفوضة' : 'قيد الانتظار') }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="row text-start">
                                                        <div class="col-md-6">
                                                            <h6 class="text-muted">تفاصيل الرحلة</h6>
                                                            <p><strong>البداية:</strong>
                                                                {{ $transportationRequest->trip->start ?? '-' }}</p>
                                                            <p><strong>النهاية:</strong>
                                                                {{ $transportationRequest->trip->end ?? '-' }}</p>
                                                            <p><strong>المسافة:</strong>
                                                                {{ $transportationRequest->trip->distance ?? '-' }} كم</p>
                                                            <p><strong>عدد المقاعد:</strong>
                                                                {{ $transportationRequest->trip->number_of_seats ?? '-' }}
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="text-muted">تفاصيل إضافية</h6>
                                                            <p><strong>نوع الرحلة:</strong>
                                                                {{ $transportationRequest->trip->trip_type ?? '-' }}</p>
                                                            <p><strong>السعر:</strong>
                                                                {{ $transportationRequest->trip->price ?? '-' }} ريال</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-danger text-white"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">لا توجد طلبات نقل حالية</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        {{-- finance --}}
        <!-- Finance Orders Section -->
        <div id="finance" class="content-section">
            <div class="table-responsive">
                <div class="container financing-container global-table">
                    <div class="table-wrapper">
                        <div class="table-title d-flex justify-content-between align-items-center">
                            <h2 class="m-0">طلبات التمويل</h2>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم الشركة</th>
                                    <th>الرقم الجامعي</th>
                                    <th>الغرض</th>
                                    <th>المبلغ</th>
                                    <th>تاريخ الطلب</th>
                                    <th>حالة الطلب</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($financeRequests as $index => $request)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $request->financingCompany->name ?? 'غير متوفر' }}</td>
                                        <td>{{ $request->student->student->university_number ?? 'غير متوفر' }}</td>
                                        <td>{{ $request->finance_type }}</td>
                                        <td>{{ $request->amount }} ريال</td>
                                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $request->status == 'completed' ? 'success' : ($request->status == 'rejected' ? 'danger' : ($request->status == 'accepted' ? 'success' : 'warning')) }}">
                                                {{ $request->status == 'completed' ? 'مكتملة' : ($request->status == 'rejected' ? 'مرفوضة' : ($request->status == 'accepted' ? 'مقبولة' : 'قيد الانتظار')) }}
                                            </span>
                                        </td>
                                        <td class="actions">
                                            @if ($request->installments()->where('status', 'paid')->count() === 12)
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#financeOrderModal{{ $request->id }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            @elseif ($request->status == 'accepted')
                                                <a href="{{ route('installment.show', $request->id) }}">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            @endif


                                        </td>
                                    </tr>

                                    <!-- Modal for Finance Order -->
                                    <div class="modal fade orders-section-modal"
                                        id="financeOrderModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div
                                                        class="info-section d-flex justify-content-between align-items-start">
                                                        <div class="text-start" style="width: 50%;">
                                                            <h5>جامعة {{ $request->financingCompany->name ?? 'غير متوفر' }}
                                                            </h5>
                                                            <p class="text-muted">مكتب
                                                                {{ $request->financingCompany->financingCompany->address ?? 'غير متوفر' }}
                                                            </p>
                                                            <p class="text-muted">
                                                                {{ $request->financingCompany->financingCompany->description ?? 'غير متوفر' }},
                                                            <p class="text-muted">
                                                                {{ $request->financingCompany->financingCompany->phone_number ?? 'غير متوفر' }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <h5>طلب رقم {{ $request->id }}</h5>
                                                            <p class="text-muted">تاريخ الإصدار:
                                                                {{ $request->created_at->format('d/m/Y') }}</p>
                                                            <p class="text-muted">حالة الطلب:
                                                                @if ($request->status == 'accepted')
                                                                    <span class="badge bg-success">مقبولة</span>
                                                                @elseif($request->status == 'rejected')
                                                                    <span class="badge bg-danger">مرفوضة</span>
                                                                @else
                                                                    <span class="badge bg-warning">قيد الانتظار</span>
                                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="divider my-4"></div>
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="col-md-4">
                                                            <h6 class="fw-bold">طلب تمويل إلى:</h6>
                                                            <p><strong>الوسيط:</strong>
                                                                {{ '4USUCCESS' }}</p>
                                                            <p><strong>الطالب:</strong>
                                                                {{ $request->student->name ?? 'غير متوفر' }}</p>
                                                            <p><strong>الرقم الجامعي:</strong>
                                                                {{ $request->student->student->university_number ?? 'غير متوفر' }}
                                                            </p>
                                                            <p><strong>رقم الهاتف:</strong>
                                                                {{ $request->student->student->student_phone_number ?? 'غير متوفر' }}
                                                            </p>
                                                            <p><strong>الغرض:</strong>
                                                                {{ $request->description ?? 'غير متوفر' }}</p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h6 class="fw-bold">الدفع عبر:</h6>
                                                            <p><strong>المبلغ:</strong> {{ $request->amount }} ريال سعودي
                                                            </p>
                                                            <p><strong>اسم البنك:</strong>
                                                                {{ $request->bank_name ?? 'غير متوفر' }}</p>
                                                            <p><strong>الدولة:</strong>
                                                                {{ $request->country ?? 'غير متوفر' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-danger text-white"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">لا توجد طلبات تمويل حالية</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- filepath: resources/views/dashboards/students/orders.blade.php --}}

        {{-- Consult Section --}}
        <div id="consult" class="content-section">
            <div class="table-responsive">
                <div class="container financing-container global-table">
                    <div class="table-wrapper">
                        <div class="table-title d-flex justify-content-between align-items-center">
                            <h2 class="m-0">طلبات الاستشارة</h2>
                        </div>
                        <table id="consultationTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المستشار</th>
                                    <th>التخصص</th>
                                    <th>موضوع الإستشارة</th>
                                    <th>نوع الاستشارة</th>
                                    <th>حالة الطلب</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($consultationRequests as $index => $request)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm ms-2 bg-light rounded p-1">
                                                        <img src="{{ asset($request->consultant->profile_image) ?? asset('images/user-logo.svg') }}"
                                                            alt="Product Image" class="img-fluid d-block"
                                                            style="width: 50px; height: 50px;">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-14 mb-1">
                                                        <a href="#"
                                                            class="text-body">{{ $request->consultant->name }}</a>
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        {{ $request->consultant->consultant->specialization ?? 'غير متوفر' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $request->specialization }}</td>
                                        <td>{{ $request->subject }}</td>
                                        <td>{{ $request->type }}</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'accepted' => 'success',
                                                    'rejected' => 'danger',
                                                    'pending' => 'warning',
                                                ];

                                                $statusLabels = [
                                                    'accepted' => 'مقبول',
                                                    'rejected' => 'مرفوضة',
                                                    'pending' => 'قيد الانتظار',
                                                ];
                                            @endphp

                                            <span class="badge bg-{{ $statusColors[$request->status] ?? 'secondary' }}">
                                                {{ $statusLabels[$request->status] ?? $request->status }}
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <div class=" d-flex gap-3">
                                                @if ($request->status == 'accepted')
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#orderModal{{ $request->id }}">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                    @if ($request->consultant->rate() > 0)
                                                        <div class="star-container   position-relative">
                                                            <span class="stars-active"
                                                                style="width:{{ $request->consultant->rate() * 20 }}% ">
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                            </span>

                                                            <span class="stars-inactive">
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                                <span> &#9733;</span>
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="rating  d-flex"
                                                            id="rating-{{ $request->consultant->id }}">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <span data-value="{{ $i }}"
                                                                    onclick="rateConsultant({{ $request->consultant->id }}, {{ $i }})"
                                                                    class="rating-star ">&#9733;</span>
                                                            @endfor
                                                        </div>
                                                    @endif
                                                @else
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#orderModal{{ $request->id }}">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>


                                    <!-- Modal for each request -->
                                    <div class="modal fade orders-section-modal" id="orderModal{{ $request->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="info-section d-flex justify-content-between">
                                                        <div class="text-start">
                                                            <div class="image-container d-flex align-items-center">
                                                                <img src="{{ isset($request->student->profile_image) ? asset($request->student->profile_image) : asset('images/user-logo.svg') }}"
                                                                    alt="{{ $request->student->profile_image ?? 'Profile Image' }}"
                                                                    class="me-3" style="">
                                                                <h5 class="ms-3">
                                                                    {{ $request->student->name ?? 'لا يوجد' }}</h5>
                                                            </div>
                                                            {{-- <p class="text-muted mt-3"><strong>التخصص:</strong> {{ $request->specialization }}</p> --}}
                                                            <p class="text-muted"> <strong>التخصص:</strong>
                                                                {{ $request->consultant->consultant->specialization ?? 'لا يوجد' }}
                                                            </p>
                                                            <p class="text-muted"> <strong>مدة الاستشارة:</strong>
                                                                {{ $request->consultant->consultant->consultation_duration ?? 'لا يوجد' }}
                                                            </p>
                                                            <p class="text-muted"> <strong>نوع النشاط:</strong>
                                                                {{ $request->consultant->consultant->activity_type ?? 'لا يوجد' }}
                                                            </p>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h5>طلب رقم {{ $request->id }}</h5>
                                                            <p class="text-muted">تاريخ الطلب:
                                                                {{ $request->request_date }}
                                                            </p>
                                                            <p class="status-box">حالة الطلب:
                                                                @if ($request->status == 'pending')
                                                                    <span class="badge bg-warning">قيد الانتظار</span>
                                                                @elseif($request->status == 'accepted')
                                                                    <span class="badge bg-success">مقبول</span>
                                                                @elseif($request->status == 'rejected')
                                                                    <span class="badge bg-danger">مرفوضة</span>
                                                                @endif
                                                                {{-- class="badge badge-{{ $request->status_color }}">{{ $request->status }}</span> --}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="divider my-4"></div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-md-4">
                                                            <h6 class="fw-bold">معلومات الطلب</h6>
                                                            <p><strong>التخصص:</strong> {{ $request->specialization }}</p>
                                                            <p><strong>نوع الاستشارة:</strong> {{ $request->type }}</p>
                                                            <p><strong>موضوع الاستشارة:</strong> {{ $request->subject }}
                                                            </p>
                                                            <p class="text-muted"> <strong>الجنس:</strong>
                                                                {{ $request->gender ? 'ذكر' : 'أنثى' ?? 'لا يوجد' }}
                                                            </p>
                                                        </div>
                                                        @if ($request->status == 'rejected')
                                                            <div class="col-md-4">
                                                                <h6 class="fw-bold">سبب الرفض</h6>
                                                                <p>
                                                                    {{ $request->reply }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-danger text-white"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                    {{-- @if ($request->status == 'pending')
                                                        <a href="{{ route('consultation.request.accept', $request->id) }}"
                                                            class="btn custom-success">قبول</a>
                                                        <a href="{{ route('consultation.request.reject', $request->id) }}"
                                                            class="btn custom-danger">رفض</a>
                                                    @elseif($request->status == 'accepted')
                                                        <a href="{{ route('consultation.request.complete', $request->id) }}"
                                                            class="btn btn-info">إكمال</a>
                                                    @endif --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لا توجد طلبات استشارة حالية</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- madal details -->
    <div class="modal fade orders-section-modal " id="orderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="info-section">
                        <div class="text-start">
                            <div class="image-container">
                                <img src="../img/cons-1.jpg" alt="السكن الجامعي">
                                <h5 class="ms-3">السكن الجامعي </h5>
                            </div>
                            <p class="text-muted">مكتب . جنوب العلامة التجارية<br>الرياض، المملكة العربية السعودية</p>
                            <p class="text-muted">+966 (555) 456 7891, +966 (555) 543 2198</p>
                        </div>
                        <div>
                            <h5>طلب رقم 125</h5>
                            <p class="text-muted">تاريخ الطلب: 25/8/2024</p>
                            <p class="status-box">حالة الطلب: مكتمل</p>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row text-start">
                        <div class="col-md-4">
                            <h6 class="text-muted">طلب سكن</h6>
                            <p><strong>الوسيط:</strong> 4SUCCESS</p>
                            <p><strong>اسم الطالب:</strong> أمان الذيابي</p>
                            <p><strong>الرقم الجامعي:</strong> 213568879</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">معلومات السكن</h6>
                            <p><strong>رقم السكن:</strong> 002</p>
                            <p><strong>السعر:</strong> 150 ريال</p>
                            <p><strong>الموقع:</strong> المدينة الرياض - حي 546</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">الدفع</h6>
                            <p><strong>طريقة الدفع:</strong> ابل باي</p>
                            <p><strong>إجمالي المبلغ:</strong> 1000 ريال</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <br><br>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#tableID').DataTable({
                // pageLength: 1,
                "language": {
                    "decimal": "",
                    "emptyTable": "لا توجد بيانات متاحة في الجدول",
                    "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "infoEmpty": "عرض 0 إلى 0 من أصل 0 مدخل",
                    "infoFiltered": "(تمت تصفيته من إجمالي _MAX_ مدخل)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "عرض _MENU_ مدخلات",
                    "loadingRecords": "جارٍ التحميل...",
                    "processing": "جارٍ المعالجة...",
                    "search": "البحث: ",
                    "zeroRecords": "لم يتم العثور على نتائج مطابقة",
                    "paginate": {
                        "first": "الأول",
                        "last": "الأخير",
                        "next": "التالي",
                        "previous": "السابق"
                    },
                    "aria": {
                        "sortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
            $('#consultationTable').DataTable({
                // pageLength: 1,
                "language": {
                    "decimal": "",
                    "emptyTable": "لا توجد بيانات متاحة في الجدول",
                    "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "infoEmpty": "عرض 0 إلى 0 من أصل 0 مدخل",
                    "infoFiltered": "(تمت تصفيته من إجمالي _MAX_ مدخل)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "عرض _MENU_ مدخلات",
                    "loadingRecords": "جارٍ التحميل...",
                    "processing": "جارٍ المعالجة...",
                    "search": "البحث: ",
                    "zeroRecords": "لم يتم العثور على نتائج مطابقة",
                    "paginate": {
                        "first": "الأول",
                        "last": "الأخير",
                        "next": "التالي",
                        "previous": "السابق"
                    },
                    "aria": {
                        "sortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });

        });
    </script>

    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');

            document.querySelectorAll('.nav-link').forEach(nav => {
                nav.classList.remove('active');
            });
            document.querySelector(`[data-section="${sectionId}"]`).classList.add('active');
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let rows = document.querySelectorAll("table tbody tr");

            rows.forEach(row => {
                row.addEventListener("mouseenter", function() {
                    this.style.transform = "scale(1.02)"; // تكبير بسيط عند التمرير
                    this.style.transition = "transform 0.3s ease-in-out";
                    this.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.1)"; // ظل خفيف
                });

                row.addEventListener("mouseleave", function() {
                    this.style.transform = "scale(1)"; // يرجع للحجم الطبيعي عند خروج الماوس
                    this.style.boxShadow = "none";
                });
            });
        });
    </script>
    <script>
        function rateHouse(houseId, ratingValue) {
            fetch(`/rate-house`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        housing_id: houseId,
                        value: ratingValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateStars(houseId, ratingValue);
                        updateRatingDisplay(houseId, data.averageRating);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function rateConsultant(consultantId, ratingValue) {
            fetch(`/rate-consultant`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        consultant_id: consultantId,
                        value: ratingValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateStars(consultantId, ratingValue);
                        updateRatingDisplay(consultantId, data.averageRating);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function updateStars(houseId, ratingValue) {
            const container = document.getElementById(`rating-${houseId}`);
            const stars = container.querySelectorAll('.rating-star');
            stars.forEach(star => {
                const value = parseInt(star.getAttribute('data-value'));
                if (value <= ratingValue) {
                    star.classList.add('checked');
                } else {
                    star.classList.remove('checked');
                }
            });
        }

        function updateRatingDisplay(houseId, averageRating) {
            const container = document.querySelector('.star-container .stars-active');
            // alert(newRating);
            if (container) {

                container.style.width = `${averageRating * 20}%`;
            }
        }
    </script>
@endsection
