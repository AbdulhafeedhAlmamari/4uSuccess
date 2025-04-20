@extends('layouts.app')
@section('title')
    {{ __('لوحة التحكم') }}
@endsection
@section('css')
    <!-- jQuery -->
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script> --}}

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/or.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/table.css') }}" rel="stylesheet">


    <style>
        .nav-pills .nav-link {
            background: #a8aaae;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 20px;
            width: 250px;
            text-align: center;
        }

        .nav-pills .nav-item {
            margin-right: 20px;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(90deg, #54B6B7 0%, #61528B 100%);
        }
    </style>
@endsection
@section('content')
    <br><br>

    <div class="container mt-5">
        <!-- Main row -->
        <div class="row ">
            <!-- First Column (Tabs) -->
            <div class="col-12 mb-4 ">
                <ul class="nav nav-pills justify-content-center align-content-center gap-5">
                    <li class="nav-item">
                        <a class="nav-link active" id="requests-tab" data-bs-toggle="pill" href="#requests">طلبات
                            الانضمام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="users-tab" data-bs-toggle="pill" href="#users">المستخدمين</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Tab content -->
        <div class="tab-content">
            <!-- Requests Tab -->
            <div class="tab-pane fade show active" id="requests">
                <div class="container">
                    <h2 class="my-4">طلبات الانضمام</h2>
                    <div class="row shadow rounded p-3">
                        <!-- First Row: Summary Cards -->
                        <div class="col-md-4 d-flex justify-content-between align-items-center ">
                            <div class="right-content">
                                <p class="m-1">{{ $approvedConsultants }}</p>
                                <h6 class="">طلب مقبول</h6>
                            </div>
                            <div class="left-content">
                                <i class="fa-solid fa-check-double"></i>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex justify-content-between align-items-center">
                            <div class="right-content  border-2 border-start ps-3">
                                <p class="m-1">{{ $pendingConsultants }}</p>
                                <h6 class="">طلب قيد الانتظار</h6>
                            </div>
                            <div class="left-content">
                                <i class="fa-solid fa-calendar"></i>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-between align-items-center">
                            <div class="right-content  border-2 border-start ps-3">
                                <p class="m-1">{{ $rejectedConsultants }}</p>
                                <h6 class="">طلب مرفوض</h6>
                            </div>
                            <div class="left-content">
                                <i class="fa-solid fa-x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table of Requests -->

                <div class="table-responsive shadow mt-3 p-3">
                    <!-- make select list -->
                    <select class="form-select w-25 ms-auto mb-2" id="requestFilter" aria-label="Default select example">
                        <option value="all" selected>الكل</option>
                        <option value="0">قيد الانتظار</option>
                        <option value="1">طلب مقبول</option>
                        <option value="2">طلب مرفوض</option>
                    </select>
                    <table id="tableID" class="display nowrap consultant-container">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الإلكتروني</th>
                                <th>نوع الحساب</th>
                                <th>تاريخ التسجيل</th>
                                <th>الاجرائات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersRequest as $index => $user)
                                <tr data-status="{{ $user->is_approved }}" data-role="{{ $user->role }}">
                                    <td class="pe-3">{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == 'student')
                                            <span class="badge bg-warning">طالب</span>
                                        @elseif($user->role == 'consultant')
                                            <span class="badge bg-info">مستشار</span>
                                        @elseif($user->role == 'housing')
                                            <span class="badge bg-success">شركة سكن</span>
                                        @elseif($user->role == 'transportation')
                                            <span class="badge bg-primary">شركة نقل</span>
                                        @elseif($user->role == 'financing')
                                            <span class="badge bg-secondary">شركة تمويل</span>
                                        @elseif($user->role == 'admin')
                                            <span class="badge bg-danger">مدير النظام</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($user->is_approved != 1)
                                            <a
                                                href="{{ route('admin.User.update.request', ['id' => $user->id, 'is_approved' => 1]) }}"class="btn btn-link m-0 p-0">
                                                <i class="fa-solid fa-check-circle text-success"></i>
                                            </a>
                                        @endif
                                        @if ($user->is_approved == 1 || $user->is_approved == 0)
                                            <a href="{{ route('admin.User.update.request', ['id' => $user->id, 'is_approved' => 2]) }}"
                                                class="btn btn-link">
                                                <i class="fa-solid fa-xmark-circle text-danger"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users Tab -->
            <div class="tab-pane fade" id="users">
                <div class="container">
                    <h2 class="my-4">المستخدمين</h2>
                    <!-- cards -->
                    <div class="row p-0">
                        <div class="col-md-2">
                            <!-- card -->
                            <div class="card card-animate shadow w-100">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-start gap-2 ">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-1 px-2 ">
                                                <i class="fa-solid fa-user text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="">الطلاب</span>
                                            <p class="fs-22 fw-semibold ff-secondary mb-4">{{ $studentsCount }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            مجموع المستخدمين
                                        </p>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->

                        </div><!-- end col -->

                        <div class="col-md-2">
                            <!-- card -->
                            <div class="card card-animate shadow w-100">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-start gap-2 ">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded fs-1 px-2 ">
                                                <i class="fa-solid fa-user-tie text-info"></i>
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="">المستشارين</span>
                                            <p class="fs-22 fw-semibold ff-secondary mb-4">{{ $consultantsCount }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            مجموع المستشارين
                                        </p>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-2">
                            <!-- card -->
                            <div class="card card-animate shadow w-100">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-start gap-2 ">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-secondary-subtle rounded fs-1 px-2 ">
                                                <i class="fa-solid fa-money-bill text-secondary"></i>
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="">شركة التمويل</span>
                                            <p class="fs-22 fw-semibold ff-secondary mb-4">{{ $financeCount }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            مجموع شركة التمويل
                                        </p>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-2">
                            <!-- card -->
                            <div class="card card-animate shadow w-100">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-start gap-2 ">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-1 px-2 ">
                                                <i class="fa-solid fa-building text-success"></i>
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="">شركات السكن</span>
                                            <p class="fs-22 fw-semibold ff-secondary mb-4">{{ $housingCount }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            مجموع شركات السكن
                                        </p>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-md-2">
                            <!-- card -->
                            <div class="card card-animate shadow w-100">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-start gap-2 ">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-1 px-2 ">
                                                <i class="fa-solid fa-car text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <span class="">شركات النقل</span>
                                            <p class="fs-22 fw-semibold ff-secondary mb-4">{{ $transportationCount }}</p>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            مجموع شركات النقل
                                        </p>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>

                    <div class="table-responsive shadow mt-3 p-3">
                        <!-- select list -->
                        <select class="form-select w-25 ms-auto mb-2" id="userFilter"
                            aria-label="Default select example">
                            <option value="all" selected>الكل</option>
                            <option value="student">الطلاب</option>
                            <option value="consultant">المستشارين</option>
                            <option value="housing">شركات السكن</option>
                            <option value="transportation">شركات النقل</option>
                            <option value="financing">شركات التمويل</option>
                        </select>
                        <table id="tableID2" class="display nowrap consultant-container">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المستخدم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>نوع الحساب</th>
                                    <th>تاريخ التسجيل</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr data-role="{{ $user->role }}">
                                        <td class="pe-3">{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role == 'student')
                                                <span class="badge bg-warning">طالب</span>
                                            @elseif($user->role == 'consultant')
                                                <span class="badge bg-info">مستشار</span>
                                            @elseif($user->role == 'housing')
                                                <span class="badge bg-success">شركة سكن</span>
                                            @elseif($user->role == 'financing')
                                                <span class="badge bg-secondary">شركة تمويل</span>
                                            @elseif($user->role == 'transportation')
                                                <span class="badge bg-primary">شركة نقل</span>
                                            @elseif($user->role == 'admin')
                                                <span class="badge bg-danger">مدير النظام</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('d M Y') }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.user.edit', $user->id) }}"
                                                class="btn btn-link pe-0">
                                                <i class="fa-regular fa-pen-to-square text-warning"></i>
                                            </a>
                                            @if ($user->role != 'admin')
                                                <a href="{{ route('admin.user.delete', $user->id) }}"
                                                    class="btn btn-link pe-0"
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                                    <i class="fa-regular fa-trash-can text-danger"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.user.show', $user->id) }}"
                                                class="btn btn-link pe-0">
                                                <i class="fa-regular fa-eye text-success"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table1 = $('#tableID').DataTable({
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

            var table2 = $('#tableID2').DataTable({
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

            // Filter user requests by status
            // فلترة طلبات الانضمام حسب الحالة
            $('#requestFilter').on('change', function() {
                var status = $(this).val();

                if (status === 'all') {
                    table1.rows().every(function() {
                        $(this.node()).show();
                    });
                } else {
                    table1.rows().every(function() {
                        var rowStatus = $(this.node()).data('status');
                        if (rowStatus == status) {
                            $(this.node()).show();
                        } else {
                            $(this.node()).hide();
                        }
                    });
                }
                table1.draw(false); // إعادة رسم الجدول دون إعادة التهيئة
            });

            // فلترة المستخدمين حسب النوع
            $('#userFilter').on('change', function() {
                var role = $(this).val();

                if (role === 'all') {
                    table2.rows().every(function() {
                        $(this.node()).show();
                    });
                } else {
                    table2.rows().every(function() {
                        var rowRole = $(this.node()).data('role');
                        if (rowRole == role) {
                            $(this.node()).show();
                        } else {
                            $(this.node()).hide();
                        }
                    });
                }
                table2.draw(false); // إعادة رسم الجدول دون إعادة التهيئة
            });


            // Row hover effect
            document.addEventListener("DOMContentLoaded", function() {
                let rows = document.querySelectorAll("table tbody tr");

                rows.forEach(row => {
                    row.addEventListener("mouseenter", function() {
                        this.style.transform = "scale(1.02)";
                        this.style.transition = "transform 0.3s ease-in-out";
                        this.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.1)";
                    });

                    row.addEventListener("mouseleave", function() {
                        this.style.transform = "scale(1)";
                        this.style.boxShadow = "none";
                    });
                });
            });
        });
    </script>
@endsection
