{{-- filepath: e:\My students\2024-2025\term 1\مشاريع تخرج\افنان\العملي\4uSuccess\resources\views\dashboards\finances\orders.blade.php --}}
@extends('layouts.app')
@section('title')
    {{ __('الطلبات') }}
@endsection
@section('css')
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/table.css') }}" rel="stylesheet">


    <style>
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
            /* justify-content: space-between; */
            gap: 10rem;
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
    <!-- finance orders section -->
    <div class="container financing-container ">
        <div class="table-wrapper global-table">
            <div class="table-title d-flex justify-content-between align-items-center">
                @if (request('status') == 'under_review')
                    <h2 class="m-0"> الطلبات تحت الدراسة للتمويل</h2>
                @elseif (request('status') == 'accepted')
                    <h2 class="m-0"> الطلبات المقبولة للتمويل</h2>
                @elseif (request('status') == 'rejected')
                    <h2 class="m-0"> الطلبات المرفوضة للتمويل</h2>
                @elseif (request('status') == 'completed')
                    <h2 class="m-0"> الطلبات المكتملة للتمويل</h2>
                @endif

            </div>
            <div class="table-responsive py-3">
                <table id="tableID" class="display nowrap consultant-container">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>أسم الطالب</th>
                            <th>نوع التمويل</th>
                            <th>المبلغ التمويل</th>
                            <th>تاريخ التقديم</th>
                            @if (request('status') == 'rejected')
                                <th>سبب الرفض</th>
                            @endif
                            @if (request('status') != 'rejected')
                                @if (request('status') == 'completed')
                                    <th>حالة الطلب</th>
                                @else
                                    <th>الاجرائات</th>
                                @endif
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($financeRequests as $index => $request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $request->student->name }}</td>
                                <td>{{ $request->finance_type === 'education' ? 'تمويل دراسي' : 'تمويل سكن' }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->created_at }}</td>
                                @if (request('status') == 'rejected')
                                    <td>{{ $request->reply }}</td>
                                @endif

                                @if (request('status') != 'rejected')
                                    <td>
                                        @if ($request->status == 'under_review')
                                            <form action="{{ route('dashboard.finance_orders.update_status') }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $request->id }}">
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn btn-primary">قبول</button>
                                            </form>
                                            <button class="btn bg-danger text-white" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal{{ $request->id }}">رفض</button>
                                        @endif
                                        @if ($request->status == 'accepted')
                                            <form action="{{ route('dashboard.finance_orders.update_status') }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $request->id }}">
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="btn bg-success text-white">اكمال</button>
                                            </form>

                                            <a href="{{ route('installment.show', $request->id) }}" class="ms-4"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        @endif
                                        @if ($request->status !== 'accepted')
                                            {{-- show eye icon href  --}}
                                            <a href="#" class="ms-4" data-bs-toggle="modal"
                                                data-bs-target="#financeOrderModal{{ $request->id }}"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        @endif

                                    </td>
                                @endif
                            </tr>
                            <!-- Modal for Reject -->
                            <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('finance.request.reject', $request->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">رفض الطلب</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="reply{{ $request->id }}">سبب الرفض:</label>
                                                    <textarea name="reply" id="reply{{ $request->id }}" class="form-control" rows="4" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary bg-danger text-white"
                                                    data-bs-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-primary">إرسال</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade orders-section-modal" id="financeOrderModal{{ $request->id }}"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div>
                                                <div class="image-container d-flex align-items-center">
                                                    <img src="{{ isset($request->student->profile_image) ? asset('storage/' . $request->student->profile_image) : asset('images/user-logo.svg') }}"
                                                        alt="{{ $request->student->profile_image ?? 'Profile Image' }}"
                                                        class="me-3" style="">
                                                    <h5 class="ms-3">
                                                        {{ $request->student->name ?? 'لا يوجد' }}</h5>
                                                </div>

                                                {{-- <h5> {{ $request->student->name ?? 'غير متوفر' }} --}}
                                                </h5>
                                                <div class="info-section d-flex align-items-start">
                                                    <div class="text-start" style="width: 50%;">
                                                        <p class="text-muted">
                                                            رقم الطلب

                                                        </p>
                                                        <p class="text-muted">
                                                            تاريخ التقديم

                                                        <p class="text-muted">
                                                            حالة الطلب

                                                        </p>
                                                        <p class="text-muted">
                                                            رقم الجوال
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted"> {{ $request->id }}</p>
                                                        <p class="text-muted">
                                                            {{ $request->created_at->format('d/m/Y') }}</p>
                                                        <p class="text-muted">
                                                            @if ($request->status == 'accepted')
                                                                <span class="badge bg-success">مقبولة</span>
                                                            @elseif($request->status == 'rejected')
                                                                <span class="badge bg-danger">مرفوضة</span>
                                                            @elseif($request->status == 'completed')
                                                                <span class="badge bg-danger">مكتمل</span>
                                                            @else
                                                                <span class="badge bg-warning">قيد الانتظار</span>
                                                            @endif
                                                        </p>
                                                        <p class="text-muted">
                                                            {{ $request->student->student->student_phone_number ?? 'لا يوجد' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider my-4"></div>
                                            <div>
                                                <h5>تفاصيل التمويل:</h5>
                                                <div class="info-section d-flex align-items-start">
                                                    <div class="text-start" style="width: 50%;">
                                                        <p class="text-muted">نوع التمويل</p>
                                                        <p class="text-muted">
                                                            المبلغ المطلوب
                                                        </p>
                                                        <p class="text-muted">وصف التمويل</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted">
                                                            {{ $request->finance_type === 'education' ? 'تمويل دراسي' : 'تمويل سكني' }}
                                                        </p>
                                                        <p class="text-muted">
                                                            {{ $request->amount ?? 0 }}</p>
                                                        <p class="text-muted">{{ $request->description ?? 'لا يوجد' }}</p>
                                                    </div>
                                                </div>
                                                <div class="divider my-4"></div>
                                                <h5>معلومات الدفع :</h5>
                                                <div class="info-section d-flex align-items-start">
                                                    <div class="text-start" style="width: 50%;">
                                                        <p class="text-muted">الدولة</p>
                                                        <p class="text-muted">اسم البنك</p>
                                                        <p class="text-muted">رقم الإيبان</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-muted">المملكة العربية السعودية</p>
                                                        <p class="text-muted">
                                                            بطاقة ائتمان
                                                        </p>
                                                        <p class="text-muted">
                                                        </p>

                                                        <p class="text-muted">{{ $request->iban ?? 'لا يوجد' }}</p>
                                                    </div>
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
                        @endforeach
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
@endsection
