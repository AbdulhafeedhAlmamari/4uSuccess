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
                                <td>{{ $request->finance_type }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->created_at }}</td>
                                @if (request('status') == 'rejected')
                                    <td>{{ $request->reply }}</td>
                                @endif

                                @if (request('status') != 'rejected')
                                    {{-- filepath: e:\My students\2024-2025\term 1\مشاريع تخرج\افنان\العملي\4uSuccess\resources\views\dashboards\finances\orders.blade.php --}}
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
                                        @endif
                                        @if ($request->status == 'completed')
                                            {{-- show eye icon href  --}}
                                            <span class="badge bg-success">مكتمل</span>
                                            <a href="{{ route('dashboard.finances.details', $request->id) }}"
                                                class="ms-4"><i class="fa-solid fa-eye"></i></a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                            <!-- Modal for Reject -->
                            <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('consultation.request.reject', $request->id) }}"
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
