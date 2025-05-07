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
                        <div class="table-title d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addTripModal" class="btn custom-success">اضافة رحلة</button>
                            <div class="">

                                <h2 class="m-0">
                                    ادارة النقل
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

                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trips as $index => $trip)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $trip->plate_number }}</td>
                                        <td>{{ $trip->driver_name }}</td>
                                        <td>{{ $trip->destination }}</td>
                                        <td>{{ $trip->number_of_seats }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trip->go_date)->format('d M Y') }}</td>

                                        <td class="actions d-flex gap-4">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#tripDetailsModal{{ $trip->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a href="#" class="ms-2" data-bs-toggle="modal"
                                                data-bs-target="#editTripModal{{ $trip->id }}">
                                                <i class="fa fa-edit text-info"></i>
                                            </a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteTripModal{{ $trip->id }}">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>

                                    </tr>

                                    <div class="modal fade orders-section-modal" id="tripDetailsModal{{ $trip->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="info-section">
                                                        <div>
                                                            <h5>رقم الرحلة:
                                                                <span>{{ $trip->id ?? '-' }}</span>
                                                                {{-- Display the trip image next to the trip ID --}}
                                                                <img src="{{ asset($trip->image ?? 'images/identity_1744485552.png') }}"
                                                                    alt="صورة الرحلة" class="img-fluid rounded ms-2"
                                                                    style="width: 50px; height: 50px;">
                                                            </h5>
                                                            <p class="text-muted">اسم السائق:
                                                                <span>{{ $trip->driver_name ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">رقم اللوحة:
                                                                <span>{{ $trip->plate_number ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">الوجهة:
                                                                <span>{{ $trip->destination ?? '-' }}</span>
                                                            </p>

                                                        </div>
                                                        <div>
                                                            {{-- <h5>رقم الطلب: <span>{{ $id }}</span></h5> --}}
                                                            <p class="text-muted">تاريخ الذهاب:
                                                                <span>{{ \Carbon\Carbon::parse($trip->go_date)->format('Y-m-d H:i') ?? '-' }}</span>
                                                            </p>
                                                            <p class="text-muted">تاريخ العودة:
                                                                <span>{{ \Carbon\Carbon::parse($trip->back_date)->format('Y-m-d H:i') ?? '-' }}</span>
                                                            </p>
                                                            <p class="status-box">نوع النقل:
                                                                <span>{{ $trip->transport_type == 'group' ? 'جماعي' : 'فردي' ?? '-' }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="d-flex justify-between align-content-center">
                                                        <div class="col-md-6 ">
                                                            <h6 class="text-muted">تفاصيل الرحلة</h6>
                                                            <p><strong>البداية:</strong>
                                                                <span>{{ $trip->start ?? '-' }}</span>
                                                            </p>
                                                            <p><strong>النهاية:</strong>
                                                                <span>{{ $trip->end ?? '-' }}</span>
                                                            </p>
                                                            <p><strong>المسافة:</strong>
                                                                <span>{{ $trip->distance ?? '-' }}</span> كم
                                                            </p>
                                                            <p><strong>عدد المقاعد:</strong>
                                                                <span>{{ $trip->number_of_seats ?? '-' }}</span>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="text-muted">تفاصيل إضافية</h6>
                                                            <p><strong>نوع الرحلة:</strong>
                                                                <span>{{ $trip->trip_type == 'one_way' ? 'ذهاب' : 'ذهاب وعودة' ?? '-' }}</span>
                                                            </p>
                                                            <p><strong>السعر:</strong>
                                                                <span>{{ $trip->price ?? '-' }}</span> ريال
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editTripModal{{ $trip->id }}" tabindex="-1"
                                        aria-labelledby="editTripModalLabel{{ $trip->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('dashboard.transportations.update', $trip->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <h5 class="modal-title ms-2"
                                                            id="editTripModalLabel{{ $trip->id }}">تعديل بيانات الرحلة
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">اسم السائق</label>
                                                            <input type="text" name="driver_name" class="form-control"
                                                                value="{{ $trip->driver_name }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">رقم اللوحة</label>
                                                            <input type="text" name="plate_number" class="form-control"
                                                                value="{{ $trip->plate_number }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">الوجهة</label>
                                                            <input type="text" name="destination" class="form-control"
                                                                value="{{ $trip->destination }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">نوع النقل</label>
                                                            <select name="transport_type" class="form-select">
                                                                <option value="group"
                                                                    {{ $trip->transport_type === 'group' ? 'selected' : '' }}>
                                                                    جماعي</option>
                                                                <option value="single"
                                                                    {{ $trip->transport_type === 'single' ? 'selected' : '' }}>
                                                                    فردي</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">نقطة البداية</label>
                                                            <input type="text" name="start" class="form-control"
                                                                value="{{ $trip->start }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">نقطة النهاية</label>
                                                            <input type="text" name="end" class="form-control"
                                                                value="{{ $trip->end }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">تاريخ الذهاب</label>
                                                            <input type="datetime-local" name="go_date"
                                                                class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($trip->go_date)->format('Y-m-d\TH:i') }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">تاريخ العودة</label>
                                                            <input type="datetime-local" name="back_date"
                                                                class="form-control"
                                                                value="{{ $trip->back_date ? \Carbon\Carbon::parse($trip->back_date)->format('Y-m-d\TH:i') : '' }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">نوع الرحلة</label>
                                                            <select name="trip_type" class="form-select">
                                                                <option value="one_way"
                                                                    {{ $trip->trip_type === 'one_way' ? 'selected' : '' }}>
                                                                    ذهاب فقط</option>
                                                                <option value="round_trip"
                                                                    {{ $trip->trip_type === 'round_trip' ? 'selected' : '' }}>
                                                                    ذهاب وعودة</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">عدد المقاعد</label>
                                                            <input type="number" name="number_of_seats"
                                                                class="form-control" value="{{ $trip->number_of_seats }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">المسافة</label>
                                                            <input type="text" name="distance" class="form-control"
                                                                value="{{ $trip->distance }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">السعر</label>
                                                            <input type="number" name="price" class="form-control"
                                                                step="0.01" value="{{ $trip->price }}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">تغيير صورة الرحلة
                                                                (اختياري)
                                                            </label><br>
                                                            <img src="{{ asset($trip->image) }}"
                                                                alt="الصورة الحالية"
                                                                style="max-width: 100%; max-height: 200px; margin-bottom: 10px;">
                                                            <input type="file" name="image" class="form-control"
                                                                accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary text-white">حفظ
                                                            التعديلات</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade zoomIn" id="deleteTripModal{{ $trip->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mt-2 text-center">
                                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                            <h4>هل أنت متأكد؟</h4>
                                                            <p class="text-muted mx-4 mb-0">
                                                                هل أنت متأكد أنك تريد إزالة هذا السكن؟
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                        <button type="button" class="btn w-sm btn-custom"
                                                            data-bs-dismiss="modal ">اغلاق</button>
                                                        <form
                                                            action="{{ route('dashboard.transportations.destroy', $trip->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn w-sm btn-custom">إزالة</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">لا توجد لديك رحلات   </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTripModal" tabindex="-1" aria-labelledby="addTripModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('dashboard.transportations.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <h5 class="modal-title ms-2" id="addTripModalLabel">إضافة رحلة جديدة</h5>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم السائق</label>
                            <input type="text" name="driver_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم اللوحة</label>
                            <input type="text" name="plate_number" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوجهة</label>
                            <input type="text" name="destination" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نوع النقل</label>
                            <select name="transport_type" class="form-select">
                                <option value="group">جماعي</option>
                                <option value="single">فردي</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نقطة البداية</label>
                            <input type="text" name="start" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نقطة النهاية</label>
                            <input type="text" name="end" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الذهاب</label>
                            <input type="date" name="go_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ العودة</label>
                            <input type="date" name="back_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نوع الرحلة</label>
                            <select name="trip_type" class="form-select">
                                <option value="one_way">ذهاب فقط</option>
                                <option value="round_trip">ذهاب وعودة</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">عدد المقاعد</label>
                            <input type="number" name="number_of_seats" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">المسافة</label>
                            <input type="text" name="distance" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">السعر</label>
                            <input type="number" name="price" class="form-control" step="0.01">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">صورة الرحلة</label><br>

                            <!-- معاينة الصورة -->
                            <img id="imagePreview" src="#" alt="معاينة الصورة"
                                style="display: none; max-width: 100%; max-height: 200px; margin-bottom: 10px;" />

                            <!-- حقل الصورة (مخفي) -->
                            <input type="file" name="image" id="tripImageInput" class="form-control d-none"
                                accept="image/*">

                            <!-- زر مخصص لاختيار صورة -->
                            <button type="button" class="btn btn-outline-primary mt-2"
                                onclick="document.getElementById('tripImageInput').click();">
                                اختر صورة
                            </button>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-custom">إضافة</button>
                    </div>
                </form>
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
    <script>
        document.getElementById('tripImageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
