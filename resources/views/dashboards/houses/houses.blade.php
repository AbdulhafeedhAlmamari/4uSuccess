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
                <h2 class="m-0">عروض السكن</h2>
            </div>
            <div class="table-responsive py-3">
                <table id="tableID" class="display nowrap consultant-container">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>نوع الغرفة</th>
                            <th>السعر</th>
                            <th>المسافة</th>
                            <th>المميزات</th>
                            <th>الاجرائات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($housings as $index => $housing)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $housing->address }}</td>
                                <td>{{ $housing->housing_type }}</td>
                                <td>{{ $housing->price }} ريال</td>
                                <td>{{ $housing->distance_from_university }}</td>
                                <td>{{ Str::limit($housing->features, 30) }}</td>
                                <td class="actions d-flex gap-4">
                                    <a href="#" class="ms-2" data-bs-toggle="modal"
                                        data-bs-target="#editHouseModal{{ $housing->id }}">
                                        <i class="fa fa-edit text-info"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteHouseModal{{ $housing->id }}">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal for each housing -->
                            <div class="modal fade" id="editHouseModal{{ $housing->id }}" tabindex="-1"
                                aria-labelledby="editHouseModalLabel{{ $housing->id }}" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <h5 class="modal-title ms-auto" id="editHouseModal{{ $housing->id }}">تعديل
                                                السكن</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editHousingForm{{ $housing->id }}"
                                                action="{{ route('dashboard.houses.update', $housing->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="address{{ $housing->id }}"
                                                        class="form-label">العنوان</label>
                                                    <input type="text" class="form-control"
                                                        id="address{{ $housing->id }}" name="address"
                                                        value="{{ $housing->address }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="distance_from_university{{ $housing->id }}"
                                                        class="form-label">المسافة</label>
                                                    <input type="text" class="form-control"
                                                        id="distance_from_university{{ $housing->id }}"
                                                        name="distance_from_university"
                                                        value="{{ $housing->distance_from_university }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price{{ $housing->id }}" class="form-label">السعر</label>
                                                    <input type="number" class="form-control"
                                                        id="price{{ $housing->id }}" name="price"
                                                        value="{{ $housing->price }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="housing_type{{ $housing->id }}" class="form-label">نوع
                                                        الغرفة</label>
                                                    <input type="text" class="form-control"
                                                        id="housing_type{{ $housing->id }}" name="housing_type"
                                                        value="{{ $housing->housing_type }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="features{{ $housing->id }}"
                                                        class="form-label">المميزات</label>
                                                    <input type="text" class="form-control"
                                                        id="features{{ $housing->id }}" name="features"
                                                        value="{{ $housing->features }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description{{ $housing->id }}"
                                                        class="form-label">الوصف</label>
                                                    <textarea class="form-control" id="description{{ $housing->id }}" name="description" rows="3">{{ $housing->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rules{{ $housing->id }}"
                                                        class="form-label">القواعد</label>
                                                    <textarea class="form-control" id="rules{{ $housing->id }}" name="rules" rows="3">{{ $housing->rules }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">الصور</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label
                                                                class="upload-box d-flex flex-column align-items-center justify-content-center">
                                                                @if ($housing->primaryPhoto)
                                                                    <img src="{{ asset($housing->primaryPhoto->path) }}"
                                                                        id="preview1_{{ $housing->id }}"
                                                                        class="preview-img mb-2" width="100px"
                                                                        height="100px">
                                                                @else
                                                                    <img src="{{ asset('img/upload.png') }}"
                                                                        id="preview1_{{ $housing->id }}"
                                                                        class="preview-img mb-2" width="100px"
                                                                        height="100px">
                                                                @endif
                                                                <span class="fw-bold">الصورة الرئيسية</span>
                                                                <small class="text-muted">قم برفع الصورة الرئيسية
                                                                    للسكن</small>
                                                                <input type="file" name="primary_image"
                                                                    accept="image/*"
                                                                    onchange="previewImage(event, 'preview1_{{ $housing->id }}')">
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label
                                                                class="upload-box d-flex flex-column align-items-center justify-content-center">
                                                                <img src="{{ asset('img/upload.png') }}"
                                                                    id="preview2_{{ $housing->id }}"
                                                                    class="preview-img mb-2" width="100px"
                                                                    height="100px">
                                                                <span class="fw-bold">صور إضافية</span>
                                                                <small class="text-muted">قم برفع صور إضافية للسكن (يمكن
                                                                    اختيار عدة صور)</small>
                                                                <input type="file" name="additional_images[]"
                                                                    accept="image/*" multiple
                                                                    onchange="previewMultipleImages(event, 'additional-images-preview_{{ $housing->id }}')">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="additional-images-preview_{{ $housing->id }}"
                                                        class="row mt-3">
                                                        @foreach ($housing->photos->where('is_primary', false) as $photo)
                                                            <div class="col-md-3 mb-2">
                                                                <img src="{{ asset($photo->path) }}"
                                                                    class="img-fluid rounded"
                                                                    style="height: 100px; object-fit: cover;">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-custom">تحديث</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal for each housing -->
                            <div class="modal fade zoomIn" id="deleteHouseModal{{ $housing->id }}" tabindex="-1"
                                aria-hidden="true">
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
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">اغلاق</button>
                                                <form action="{{ route('dashboard.houses.destroy', $housing->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn w-sm btn-danger">إزالة</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach($housings as $index => $housing)

                        {{-- @empty
                           <tr>
                                <td colspan="7" class="text-center">لا توجد بيانات متاحة</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal add -->
    <div class="modal fade" id="addHouseModal" tabindex="-1" aria-labelledby="addHouseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title ms-auto" id="addHouseModalLabel">أضافة سكن</h5>
                </div>
                <form action="{{ route('dashboard.houses.request') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="driverName" class="form-label">العنوان</label>
                            <input type="text" class="form-control" id="driverName"
                                placeholder="شارع الملك عبدالعزيز، حي الجامعة، الرياض 11451" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">المسافة</label>
                            <input type="text" class="form-control" id="destination"
                                placeholder="يبعد عن الجامعة 5 كيلومتر" name="distance_from_university">
                        </div>
                        <div class="mb-3">
                            <label for="seats" class="form-label">السعر</label>
                            <input type="number" class="form-control" id="seats" placeholder="500 ريال شهريا"
                                name="price">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">نوع الغرفة</label>
                            <input type="text" class="form-control" id="date" placeholder="غرفة مشتركة"
                                name="housing_type">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">المميزات</label>
                            <input type="text" class="form-control" id="date"
                                placeholder="مثل واي فاي - موقف سيارات - غسيل ملابس - صالة العاب" name="features">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea class="form-control" id="description" rows="3"
                                placeholder="وصف السكن جامعي حديث مع غرفة مفروشة بالكامل ومرافق متكاملة" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rules" class="form-label">القواعد</label>
                            <textarea class="form-control" id="rules" rows="3"
                                placeholder="مسموح بالزوار حتى الساعة 10 مساء، الالتزام بالهدوء بعد منتصف الليل" name="rules"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                                    <img src="../img/upload.png" id="preview1" class="preview-img mb-2" width="100px"
                                        height="100px">
                                    <span class="fw-bold">صورة السكن</span>
                                    <small class="text-muted">قم برفع صورة للسكن الجامعي </small>
                                    <input type="file" accept="image/*" onchange="previewImage(event, 'preview1')"
                                        name="primary_image">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="upload-box d-flex flex-column align-items-center justify-content-center">
                                    <img src="../img/upload.png" id="preview2" class="preview-img mb-2" width="100px"
                                        height="100px">
                                    <span class="fw-bold">صورة السكن</span>
                                    <small class="text-muted">قم برفع صورة للسكن الجامعي</small>
                                    <input type="file" accept="image/*" onchange="previewImage(event, 'preview2')"
                                        name="additional_images[]">
                                </label>
                            </div>
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
        // function previewImage(event, previewId) {
        //     const file = event.target.files[0];
        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             const preview = document.getElementById(previewId);
        //             preview.src = e.target.result;
        //             preview.style.display = "block";
        //         }
        //         reader.readAsDataURL(file);
        //     }
        // }
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

        function previewMultipleImages(event, containerId) {
            const files = event.target.files;
            const previewContainer = document.getElementById(containerId);
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
