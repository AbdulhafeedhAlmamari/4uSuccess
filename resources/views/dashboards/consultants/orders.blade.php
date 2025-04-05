@extends('layouts.app')
@section('title')
    {{ __('الطلبات') }}
@endsection
@section('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
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

        /* modal */
        .modal-content {
            border-radius: 15px;
            padding: 20px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
            justify-content: center;
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
                        <div class="table-title d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addTripModal"><i class="fa fa-add"></i> <span>اضافة
                                    رحلة</span></button>
                            <div class="">
                                <h2 class="m-0">طلبات استشارة حالية</h2>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الطالب</th>
                                    <th>الرقم الجامعي</th>
                                    <th>موضوع الإستشارة</th>
                                    <th>نص الطلب</th>
                                    <th>حالة الطلب</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>بشرى العتيبي</td>
                                    <td>44104047</td>
                                    <td>إختيار التخصص</td>
                                    <td>السلام عليكم أرغب في معرفة التخصصات المختلفة داخل كليا العلوم</td>
                                    <td>
                                        <div class="d-flex justify-content-start gap-1">
                                            <!-- قبول -->
                                            <a href="#" class="btn custom-success">قبول</a>
                                            <!-- رفض -->
                                            <a href="#" class="btn custom-danger">رفض</a>
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
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addTripModal" tabindex="-1" aria-labelledby="addTripModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button " class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title ms-2" id="addTripModalLabel">إضافة رحلة جديدة</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="driverName" class="form-label">اسم السائق</label>
                            <input type="text" class="form-control" id="driverName" placeholder="أكتب اسم السائق">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">الوجهه</label>
                            <input type="text" class="form-control" id="destination" placeholder="أكتب اسم المنطقة">
                        </div>
                        <div class="mb-3">
                            <label for="seats" class="form-label">عدد المقاعد</label>
                            <input type="number" class="form-control" id="seats" placeholder="أدخل عدد المقاعد">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">الموعد</label>
                            <input type="date" class="form-control" id="date" placeholder="حدد تاريخ الرحلة">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom">إضافة</button>
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
