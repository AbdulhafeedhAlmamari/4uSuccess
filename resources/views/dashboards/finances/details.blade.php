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
        body {
            background-color: #f8f9fa;
        }
        
        .table th {
            background-color: #f5f3f4;
        }
        
        .badge-paid {
            background-color: #3e92cc;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        
        .badge-unpaid {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        
        .card-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
    </style>
@endsection
@section('content')
    <br><br>


    <div class="container mt-5">
        <div class="card p-4">
            <h3 class="card-title">التفاصيل</h3>

            <table class="table text-center table-bordered">
                <tbody>
                    <tr>
                        <th>المبلغ الرئيسي</th>
                        <td>30,000 ريال</td>
                        <th>المبلغ المستحق</th>
                        <td>10,000 ريال</td>
                    </tr>
                    <tr>
                        <th>المبلغ المدفوع</th>
                        <td>20,000 ريال</td>
                        <th>الأقساط</th>
                        <td>2/3</td>
                    </tr>
                </tbody>
            </table>

            <h4 class="text-center mt-4">الوضع المالي</h4>

            <table class="table text-center table-bordered">
                <thead>
                    <tr>
                        <th>القسط</th>
                        <th>المبلغ</th>
                        <th>تاريخ الدفع</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>القسط الأول</td>
                        <td>10,000 ريال</td>
                        <td>1 يناير 2024</td>
                        <td><span class="badge-paid">تم الدفع</span></td>
                    </tr>
                    <tr>
                        <td>القسط الثاني</td>
                        <td>10,000 ريال</td>
                        <td>1 فبراير 2024</td>
                        <td><span class="badge-paid">تم الدفع</span></td>
                    </tr>
                    <tr>
                        <td>القسط الثالث</td>
                        <td>10,000 ريال</td>
                        <td>1 مارس 2024</td>
                        <td><span class="badge-unpaid">لم يتم الدفع</span></td>
                    </tr>
                </tbody>
            </table>
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
