@extends('layouts.app')
@section('title')
    {{ __('طلبات الاستشارة') }}
@endsection
@section('css')
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/table.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- consultants requests section -->
    <div class="container financing-container ">
        <div class="table-wrapper global-table">
            <div class="table-title d-flex justify-content-between align-items-center">

                <h2 class="m-0">طلباتي</h2>
            </div>
            <div class="table-responsive py-3">
                <table id="tableID" class="display nowrap consultant-container">

                    @php
                        $headers = ['اسم المستشار', 'التاريخ', 'التخصص', 'الطالب', 'حالة الطلب', 'الاجراءات'];
                        $data = [
                            [
                                'consultant_image' => 'consultant-02.png',
                                'consultant_name' => 'صالح العمري',
                                'consultant_job' => 'جامعة الملك عبدالعزيز',
                                'date' => '10 مارس 2025',
                                'specialization' => 'علوم الحاسب',
                                'student_name' => 'أحمد محمد',
                                'status' => 'تم الرد',
                            ],
                            [
                                'consultant_image' => 'consultant-02.png',
                                'consultant_name' => 'علي أحمد',
                                'consultant_job' => 'جامعة الملك سعود',
                                'date' => '15 مارس 2025',
                                'specialization' => 'الهندسة الكهربائية',
                                'student_name' => 'محمد خالد',
                                'status' => 'قيد المراجعة',
                            ],
                        ];
                    @endphp

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            @foreach ($headers as $header)
                                <th scope="col">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($data as $row)
                            <tr>
                                <th>{{ $counter }}</th>
                                <th>
                                    <div class="d-flex">
                                        <img src="{{ asset('build/assets/images/' . $row['consultant_image']) }}"
                                            alt="img" class="consult-img rounded" style="width: 50px; height: 50px;">
                                        <div class="ms-2">
                                            <p class="consult-name m-0">{{ $row['consultant_name'] }}</p>
                                            <p class="consult-job">{{ $row['consultant_job'] }}</p>
                                        </div>
                                    </div>
                                </th>
                                <td>{{ $row['date'] }}</td>
                                <td>{{ $row['specialization'] }}</td>
                                <td>{{ $row['student_name'] }}</td>
                                <td>{{ $row['status'] }}</td>
                                <td>
                                    <i class="far fa-eye" data-bs-toggle="modal" data-bs-target="#requestModal"></i>
                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
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
