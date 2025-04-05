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
    </style>
@endsection
@section('content')
    <br><br>
    <!-- finance orders section -->
    <div class="container financing-container">
        <div class="table-wrapper global-table">
            <div class="table-title d-flex justify-content-between align-items-center">
                <h2 class="m-0">طلبات السكن حالية</h2>
            </div>
            <div class="table-responsive py-3">
                <table id="tableID" class="display nowrap consultant-container">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الطلب</th>
                            <th>أسم الطالب</th>
                            <th>تاريخ التقديم</th>
                            <th>الايميل الجامعي</th>
                            <th>حالة الطلب</th>
                            <th>الاجرائات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                50060
                            </td>
                            <td>بشرى العتيبي</td>
                            <td>2024-05-06</td>
                            <td>example@example.com</td>
                            <td>
                                <div class="d-flex justify-content-start gap-1">
                                    <!-- مؤكده -->
                                    <a href="#" class="btn custom-success">مؤكده</a>
                                    <!-- مرفوض -->
                                    <a href="#" class="btn custom-danger">مرفوض</a>
                                </div>
                            </td>
                            <td class="actions">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <!-- <a href="#">
                                                            <i class="fa-brands fa-paypal"></i>
                                                        </a> -->
                            </td>
                        </tr>
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
@endsection
