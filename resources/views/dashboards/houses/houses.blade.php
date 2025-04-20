@extends('layouts.app')
@section('title')
    {{ __('عروض السكن') }}
@endsection
@section('css')
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <!-- Dropzone CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
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

        /* style images */
        .card {
            border-style: dashed;
            padding: 10px;
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            min-height: 150px;
            position: relative;
        }

        .upload-box:hover {
            border-color: #6c757d;
        }

        .upload-box input {
            display: none;
        }

        .upload-icon {
            font-size: 30px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .preview-img {
            max-width: 100%;
            max-height: 120px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
@endsection
@section('content')
    <br><br>
    <!-- finance orders section -->
    <div class="container financing-container">
        <div class="table-wrapper global-table">
            <div class="table-title d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHouseModal"><i
                        class="fa fa-add"></i> <span>اضافة
                        سكن</span></button>
                <h2 class="m-0">طلبات السكن القادمة</h2>
            </div>
            <div class="table-responsive py-3">
                <table id="tableID" class="display nowrap consultant-container">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم السكن</th>
                            <th>أسم الطالب</th>
                            <th>السعر</th>
                            <th>مدة الايجار</th>
                            <th>الحالة</th>
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
                            <td>100</td>
                            <td>اربع اشهر</td>
                            <td>
                                متاحه
                            </td>
                            <td class="actions">
                                <a href="#" class="ms-2" data-bs-toggle="modal" data-bs-target="#addTripModal">
                                    <i class="fa fa-edit text-info"></i>
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal add -->
    <div class="modal fade" id="addHouseModal" tabindex="-1" aria-labelledby="addHouseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title ms-auto" id="addHouseModalLabel">أضافة سكن</h5>
                </div>
                <div class="modal-body">
                    <form id="addHousingForm" action="{{ route('housing.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="address" class="form-label">العنوان</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="شارع الملك عبدالعزيز، حي الجامعة، الرياض 11451">
                        </div>
                        <div class="mb-3">
                            <label for="distance_from_university" class="form-label">المسافة</label>
                            <input type="text" class="form-control" id="distance_from_university" name="distance_from_university"
                                placeholder="يبعد عن الجامعة 5 كيلومتر">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">السعر</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="500 ريال شهريا">
                        </div>
                        <div class="mb-3">
                            <label for="housing_type" class="form-label">نوع الغرفة</label>
                            <input type="text" class="form-control" id="housing_type" name="housing_type" placeholder="غرفة مشتركة">
                        </div>
                        <div class="mb-3">
                            <label for="features" class="form-label">المميزات</label>
                            <input type="text" class="form-control" id="features" name="features"
                                placeholder="مثل واي فاي - موقف سيارات - غسيل ملابس - صالة العاب">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="وصف السكن جامعي حديث مع غرفة مفروشة بالكامل ومرافق متكاملة"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rules" class="form-label">القواعد</label>
                            <textarea class="form-control" id="rules" name="rules" rows="3"
                                placeholder="مسموح بالزوار حتى الساعة 10 مساء، الالتزام بالهدوء بعد منتصف الليل"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الصور</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('img/upload.png') }}" id="preview1" class="preview-img mb-2" width="100px"
                                            height="100px">
                                        <span class="fw-bold">الصورة الرئيسية</span>
                                        <small class="text-muted">قم برفع الصورة الرئيسية للسكن</small>
                                        <input type="file" name="primary_image" accept="image/*" onchange="previewImage(event, 'preview1')">
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('img/upload.png') }}" id="preview2" class="preview-img mb-2" width="100px"
                                            height="100px">
                                        <span class="fw-bold">صور إضافية</span>
                                        <small class="text-muted">قم برفع صور إضافية للسكن (يمكن اختيار عدة صور)</small>
                                        <input type="file" name="additional_images[]" accept="image/*" multiple onchange="previewMultipleImages(event)">
                                    </label>
                                </div>
                            </div>
                            <div id="additional-images-preview" class="row mt-3"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-custom">إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close deleteRecord-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>هل أنت متأكد؟</h4>
                            <p class="text-muted mx-4 mb-0">
                                هل أنت متأكد أنك تريد إزالة هذا السجل؟
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">اغلاق</button>
                        <form action="" method="POST" id="delete-form">
                            <button type="submit" class="btn w-sm btn-danger " id="delete-record">إزالة</button>
                        </form>
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
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }
                reader.readAsDataURL(file);
            }
        }

        function previewMultipleImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('additional-images-preview');
            previewContainer.innerHTML = '';

            if (files) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 mb-2';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-fluid rounded';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';

                        col.appendChild(img);
                        previewContainer.appendChild(col);
                    }

                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endsection
