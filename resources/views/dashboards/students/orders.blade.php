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
                                <th>تاريخ الطلب</th>
                                <th>الرقم الجامعــي</th>
                                <th>رقم السكن</th>
                                <th>المبلغ</th>
                                <th>حالة الطلب</th>
                                <th>الاجرائات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="#">جامعة الملك عبدالعزيز</a>
                                    <br>
                                    <span class="text-muted">غرفة سكن جامعي</span>
                                </td>
                                <td>02 مارس 2023</td>
                                <td>44104047</td>
                                <td>3222</td>
                                <td><a href="#" class="" title="التفاصيل" data-toggle="tooltip">
                                        0 ريال</a>
                                    <br>
                                    <span class="text-muted">منحة تعليم عالي</span>
                                </td>
                                <td><span class="badge bg-success">تمت الموافقة</span></td>
                                <td class="actions">
                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal">
                                                                                                                                                                                <i class="fa-regular fa-eye"></i>
                                                                                                                                                                            </a> -->
                                    <a href="#">
                                        <i class="fa-brands fa-paypal"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm ms-2 bg-light rounded p-1">
                                                    <img src="../img/bus.png" alt="Product Image" class="img-fluid d-block "
                                                        style="width: 50px; height: 50px;">

                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-1">
                                                    <a href="#" class="text-body">شركة سابتكو</a>
                                                </h5>
                                                <p class="text-muted mb-0">
                                                    خدمة نقل الجماعي
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>02 مارس 2023</td>
                                    <td>الرياض</td>
                                    <td>جامعة الاميرة نوره</td>
                                    <td><a href="#" class="" title="التفاصيل" data-toggle="tooltip">
                                            50 ريال</a>
                                    </td>
                                    <td><span class="badge bg-success">مكتمله</span></td>
                                    <td class="actions">
                                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal">
                                                                                                                                                                                    <i class="fa-regular fa-eye"></i>
                                                                                                                                                                                </a> -->
                                        <a href="#">
                                            <i class="fa-brands fa-paypal"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div id="finance" class="content-section">
            <!-- <h2 class="text-center mb-4">طلبات التمويل</h2> -->
            <div class="table-responsive">
                <div class="container financing-container global-table">
                    <div class="table-wrapper ">
                        <div class="table-title d-flex justify-content-between align-items-center">
                            <h2 class="m-0">طلبات التمويل</h2>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم الشركة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>الرقم الجامعي</th>
                                    <th>الغرض</th>
                                    <th>المبلغ</th>
                                    <th>حالة الطلب</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm ms-2 bg-light rounded p-1">
                                                    <img src="../img/bus.png" alt="Product Image" class="img-fluid d-block "
                                                        style="width: 50px; height: 50px;">

                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-1">
                                                    <a href="#" class="text-body">جامعة المستقبل</a>
                                                </h5>
                                                <p class="text-muted mb-0">
                                                    شركة تمويل
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>02 مارس 2023</td>
                                    <td>125487988</td>
                                    <td>تمويل مشروع التخرج</td>
                                    <td><a href="#" class="" title="التفاصيل" data-toggle="tooltip">
                                            5000 ريال</a>
                                        <br>
                                        <span class="text-muted">بنك الراجحي</span>
                                    </td>
                                    <td><span class="badge bg-success">مكتمله</span></td>
                                    <td class="actions">
                                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal">
                                                                                                                                                                                    <i class="fa-regular fa-eye"></i>
                                                                                                                                                                                </a> -->
                                        <a href="#">
                                            <i class="fa-brands fa-paypal"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div id="consult" class="content-section">
            <!-- <h2 class="text-center mb-4">طلبات الاستشارة</h2> -->
            <div class="table-responsive">
                <div class="container financing-container global-table">
                    <div class="table-wrapper ">
                        <div class="table-title d-flex justify-content-between align-items-center">
                            <h2 class="m-0">طلبات الاستشارة</h2>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم الشركة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>التخصص</th>
                                    <th>الطالب</th>
                                    <th>حالة الطلب</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm ms-2 bg-light rounded p-1">
                                                    <img src="../img/consultant-01.png" alt="Product Image"
                                                        class="img-fluid d-block " style="width: 50px; height: 50px;">

                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-1">
                                                    <a href="#" class="text-body">صالح العمري</a>
                                                </h5>
                                                <p class="text-muted mb-0">
                                                    جامعة الملك عبدالعزيز
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>10 مارس 2024</td>
                                    <td>علوم الحاسب</td>
                                    <td><a href="#" class="" title="التفاصيل" data-toggle="tooltip">
                                            أفنان الذيابي </a>
                                    </td>
                                    <td><span class="badge bg-success">مكتمله</span></td>
                                    <td class="actions">
                                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal">
                                                                                                                                                                                    <i class="fa-regular fa-eye"></i>
                                                                                                                                                                                </a> -->
                                        <a href="#">
                                            <i class="fa-brands fa-paypal"></i>
                                        </a>
                                    </td>
                                </tr>
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
@endsection
