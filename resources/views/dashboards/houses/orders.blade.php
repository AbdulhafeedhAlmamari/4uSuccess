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
    {{-- css --}}
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
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
    </style>
@endsection
@section('content')
    <br><br>
    <!-- finance orders section -->
    <div class="container financing-container">
        <div class="table-wrapper global-table">
            <div class="table-title d-flex justify-content-between align-items-center">
                <h2 class="m-0">
                    طلبات السكن
                    @if (request('status') == 'pending')
                        الحالية
                    @elseif(request('status') == 'confirmed')
                        السابقة
                    @else
                        المرفوضه
                    @endif
                </h2>

            </div>
            <div class="table-responsive py-3">
                <table id="tableID" class="display nowrap consultant-container">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>رقم الطلب</th> --}}
                            <th>أسم الطالب</th>
                            <th>تاريخ التقديم</th>
                            <th>الايميل الجامعي</th>
                            <th>حالة الطلب</th>
                            <th>الاجرائات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $index => $reservation)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                {{-- <td>{{ $reservation->id }}</td> --}}
                                <td>{{ $reservation->student->name ?? 'غير موجود' }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->request_date)->format('Y-m-d') }}</td>
                                <td>{{ $reservation->student->email }}</td>
                                <td>
                                    @if ($reservation->status == 'confirmed')
                                        <span class="badge bg-success">تمت الموافقة</span>
                                    @elseif ($reservation->status == 'pending')
                                        <div class="d-flex justify-content-start gap-1">
                                            <form
                                                action="{{ route('dashboard.houses.reservation.status', $reservation->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                {{-- @method('PATCH') --}}
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn custom-success">مؤكده</button>
                                            </form>
                                            <form
                                                action="{{ route('dashboard.houses.reservation.status', $reservation->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                {{-- @method('PATCH') --}}
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="button" class="btn custom-danger" data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal{{ $reservation->id }}">مرفوض</button>
                                            </form>
                                        </div>
                                    @elseif ($reservation->status == 'rejected')
                                        <span class="badge bg-danger">مرفوض</span>
                                    @else
                                        <span class="badge bg-info">مكتملة</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#housingModal{{ $reservation->id }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Modal for Reject -->
                            <div class="modal fade" id="rejectModal{{ $reservation->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dashboard.houses.reservation.status', $reservation->id) }}"
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
                                                <button type="button" class="btn btn btn-secondary bg-danger text-white"
                                                    data-bs-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn custom-success">إرسال</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- madal details -->
                            <div class="modal fade orders-section-modal" id="housingModal{{ $reservation->id }}"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="info-section">
                                                <div>
                                                    <h5>رقم السكن: <span>{{ $reservation->housing?->id ?? '-' }}</span>
                                                    </h5>
                                                    <p class="text-muted">السعر:
                                                        <span>{{ $reservation->housing?->price ?? '-' }}</span> ريال
                                                    </p>
                                                    <p class="status-box">نوع السكن:
                                                        <span>{{ $reservation->housing?->housing_type ?? '-' }}</span>
                                                    </p>
                                                </div>
                                                <div>
                                                    <h5>رقم الطلب: <span>{{ $reservation->id }}</span></h5>
                                                    <p class="text-muted">تاريخ الطلب :
                                                        <span>{{ \Carbon\Carbon::parse($reservation->request_date)->format('Y-m-d') }}</span>
                                                    </p>
                                                    <p class="text-muted">
                                                        حالة الطلب :
                                                        <span
                                                            class="badge bg-{{ $reservation->status == 'confirmed' ? 'success' : ($reservation->status == 'rejected' ? 'danger' : ($reservation->status == 'pending' ? 'warning' : 'info')) }}">
                                                            {{ $reservation->status == 'confirmed' ? 'تمت الموافقة' : ($reservation->status == 'rejected' ? 'مرفوضة' : ($reservation->status == 'pending' ? 'قيد الانتظار' : 'مكتملة')) }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="d-flex justify-between align-content-center">
                                                <div class="col-md-6">
                                                    <h6 class="text-muted">تفاصيل السكن</h6>
                                                    <p><strong>الموقع:</strong>
                                                        <span>{{ $reservation->housing?->address ?? '-' }}</span>
                                                    </p>
                                                    <p><strong>المسافة عن الجامعة:</strong>
                                                        <span>{{ $reservation->housing?->distance_from_university ?? '-' }}</span>
                                                        كم
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-muted">الوصف</h6>
                                                    <p>{{ $reservation->housing?->description ?? '-' }}</p>
                                                    <h6 class="text-muted">المميزات</h6>
                                                    <p>{{ $reservation->housing?->features ?? '-' }}</p>
                                                    <h6 class="text-muted">القواعد</h6>
                                                    <p>{{ $reservation->housing?->rules ?? '-' }}</p>
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
                        @endforelse ($reservations as $index => $reservation)

                    </tbody>
                </table>
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
        });
    </script>

    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>

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
        document.addEventListener('DOMContentLoaded', function() {
            const housingModal = document.getElementById('housingModal');

            housingModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                document.getElementById('housingId').textContent = button.getAttribute('data-housing-id') ||
                    '-';
                document.getElementById('housingPrice').textContent = button.getAttribute(
                    'data-housing-price') || '-';
                document.getElementById('housingAddress').textContent = button.getAttribute(
                    'data-housing-address') || '-';
                document.getElementById('housingDistance').textContent = button.getAttribute(
                    'data-housing-distance') || '-';
                document.getElementById('housingType').textContent = button.getAttribute(
                    'data-housing-type') || '-';
                document.getElementById('housingDescription').textContent = button.getAttribute(
                    'data-housing-description') || '-';
                document.getElementById('housingFeatures').textContent = button.getAttribute(
                    'data-housing-features') || '-';
                document.getElementById('housingRules').textContent = button.getAttribute(
                    'data-housing-rules') || '-';
                document.getElementById('reservationId').textContent = button.getAttribute(
                    'data-reservation-id') || '-';
                document.getElementById('housingStatus').textContent = button.getAttribute(
                    'data-housing-status') || '-';
                document.getElementById('reservationDate').textContent = button.getAttribute(
                    'data-reservation-request-date') || '-';
            });
        });
    </script>
@endsection
