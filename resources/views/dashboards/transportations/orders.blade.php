@extends('layouts.app')
@section('title')
    {{ __('الطلبات') }}
@endsection
@section('css')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('build/assets/css/home.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('build/assets/css/table.css') }}" rel="stylesheet">


    <style>
        .financing-container .table-wrapper .custom-success {
            float: right;
            color: #fff;
            background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
        }

        .financing-container .table-wrapper .custom-danger {
            float: right;
            color: #fff;
            background: red;
        }

        .financing-container .table-wrapper .custom-success:hover {
            background: linear-gradient(90deg, #54b5b7db 0%, #61528bde 100%);
            color: #fff;
        }

        .financing-container .table-wrapper .custom-danger:hover {
            background: rgba(255, 0, 0, 0.442);
            color: #fff;
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

        .form-control {
            border-radius: 8px;
            padding: 10px;
        }

        .btn-custom {
            float: right;
            color: #fff;
            background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
            border-radius: 8px;
            padding: 10px 20px;
            border: none;
        }

        .btn-custom:hover {
            background: linear-gradient(90deg, #54b5b7db 0%, #61528bde 100%);
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <!-- company orders section -->
    <!-- main  -->
    <div class="container mt-5 orders-section">
        <div id="transport" class="content-section">
            <!-- <h2 class="text-center mb-4">طلبات النقل</h2> -->
            <div class="table-responsive">
                <div class="container financing-container global-table">
                    <div class="table-wrapper ">
                        <div class="table-title d-flex justify-content-end align-items-center">
                            <div class="">
                                <h2 class="m-0">
                                    طلبات النقل
                                    @if (request('status') == 'pending')
                                        الحالية
                                    @elseif(request('status') == 'completed')
                                        السابقة
                                    @else
                                        المرفوضه
                                    @endif
                                </h2>
                            </div>
                        </div>

                        <table id="tableID" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>رقم اللوحه</th>
                                    <th>أسم السائق</th>
                                    <th>الوجهه</th>
                                    <th>عدد المقاعد</th>
                                    <th>موعد الرحلة</th>
                                    <th>حالة الطلب</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reservations as $index => $reservation)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $reservation->trip->plate_number ?? '-' }}</td>
                                        <td>{{ $reservation->trip->driver_name ?? '-' }}</td>
                                        <td>{{ $reservation->trip->destination ?? '-' }}</td>
                                        <td>{{ $reservation->trip->number_of_seats ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->trip->go_date ?? '')->format('d M Y') }}
                                        </td>
                                        <td>
                                            @if ($reservation->status == 'completed')
                                                <span class="badge bg-success">مكتملة</span>
                                            @elseif($reservation->status == 'rejected')
                                                <span class="badge bg-danger">مرفوض</span>
                                            @elseif($reservation->status == 'pending')
                                                <div class="d-flex justify-content-start gap-1">
                                                    <form
                                                        action="{{ route('dashboard.transportation.reservation.status', $reservation->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        {{-- @method('PATCH') --}}
                                                        <input type="hidden" name="status" value="completed">
                                                        <button type="submit" class="btn custom-success">مؤكده</button>
                                                    </form>
                                                    <form
                                                        action="{{ route('dashboard.transportation.reservation.status', $reservation->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        {{-- @method('PATCH') --}}
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="button" class="btn custom-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rejectModal{{ $reservation->id }}">مرفوض</button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="badge bg-info">في انتظار الدفع</span>
                                            @endif
                                        </td>
                                        <td class="actions">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#orderModal{{ $reservation->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    {{-- Modal for Transportation Details --}}
                                    <div class="modal fade orders-section-modal" id="orderModal{{ $reservation->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="info-section">
                                                        <div>
                                                            <h5>رقم الرحلة:
                                                                <span>{{ $reservation->trip->id ?? '-' }}</span>
                                                                {{-- Display the trip image next to the trip ID --}}
                                                                <img src="{{ asset($reservation->trip->image ?? 'images/identity_1744485552.png') }}"
                                                                    alt="صورة الرحلة" class="img-fluid rounded ms-2"
                                                                    style="width: 50px; height: 50px;">
                                                            </h5>
                                                            <p class="text-muted">اسم السائق:
                                                                <span>{{ $reservation->trip->driver_name ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">رقم اللوحة:
                                                                <span>{{ $reservation->trip->plate_number ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">الوجهة:
                                                                <span>{{ $reservation->trip->destination ?? '-' }}</span>
                                                            </p>
                                                            <p class="status-box">نوع النقل:
                                                                <span>{{ $reservation->trip->transport_type == 'group' ? 'جماعي' : 'فردي' ?? '-' }}</span>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <h5>رقم الطلب: <span>{{ $reservation->id }}</span></h5>
                                                            <p class="text-muted">تاريخ الذهاب:
                                                                <span>{{ \Carbon\Carbon::parse($reservation->trip->go_date)->format('Y-m-d H:i') ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">تاريخ العودة:
                                                                <span>{{ \Carbon\Carbon::parse($reservation->trip->back_date)->format('Y-m-d H:i') ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">
                                                                حالة الطلب:
                                                                @if ($reservation->status == 'completed')
                                                                    <span class="badge bg-success">مكتمل</span>
                                                                @elseif ($reservation->status == 'pending')
                                                                    <span class="badge bg-warning">قيد الانتظار</span>
                                                                @elseif ($reservation->status == 'rejected')
                                                                    <span class="badge bg-danger">مرفوضة</span>
                                                                @else
                                                                    <span class="badge bg-info">في انتظار الدفع</span>
                                                                @endif


                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="d-flex justify-between align-content-center">
                                                        <div class="col-md-6">
                                                            <h6 class="text-muted">تفاصيل الرحلة</h6>
                                                            <p><strong>البداية:</strong>
                                                                <span>{{ $reservation->trip->start ?? '-' }}</span>
                                                            </p>
                                                            <p><strong>النهاية:</strong>
                                                                <span>{{ $reservation->trip->end ?? '-' }}</span>
                                                            </p>
                                                            <p><strong>المسافة:</strong>
                                                                <span>{{ $reservation->trip->distance ?? '-' }}</span> كم
                                                            </p>
                                                            <p><strong>عدد المقاعد:</strong>
                                                                <span>{{ $reservation->trip->number_of_seats ?? '-' }}</span>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="text-muted">تفاصيل إضافية</h6>
                                                            <p><strong>نوع الرحلة:</strong>
                                                                <span>{{ $reservation->trip->trip_type == 'one_way' ? 'ذهاب' : 'ذهاب وعودة' ?? '-' }}</span>
                                                            </p>
                                                            <p><strong>السعر:</strong>
                                                                <span>{{ $reservation->trip->price ?? '-' }}</span> ريال
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal for Reject -->
                                    <div class="modal fade" id="rejectModal{{ $reservation->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form
                                                    action="{{ route('dashboard.transportation.reservation.status', $reservation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">رفض الطلب</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="reply">سبب الرفض:</label>
                                                            <textarea name="reply" id="reply" class="form-control" rows="4" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn btn-secondary bg-danger text-white"
                                                            data-bs-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn custom-success">إرسال</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">لا توجد طلبات نقل </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <br><br>
    <br><br>
    <br><br><br>
@endsection

@section('script')
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
@endsection
