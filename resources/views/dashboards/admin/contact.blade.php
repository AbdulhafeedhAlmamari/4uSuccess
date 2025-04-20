@extends('layouts.app')
@section('title')
    {{ __('لوحة التحكم') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

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

        .table-title {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            /* color: #fff; */
            background-color: #f5f3f4;
            padding: 16px 25px;
            border-radius: 3px 3px 0 0;
            direction: rtl;
        }
    </style>
@endsection
@section('content')
    <!-- contact section -->

    <div class="container mt-5">


        <!-- Tab content -->
        <div class="tab-content">
            <!-- Requests Tab -->
            <div class="tab-pane fade show active" id="requests">
                <div class="container">
                </div>
                <!-- Table of Requests -->

                <div class="table-responsive shadow mt-3 p-3 position-relative pt-5">
                    <div class="table-title d-flex justify-content-between align-items-center">
                        <h2 class="m-0">الاستفســـــــــارات</h2>
                    </div>
                    <!-- select list -->
                    <select id="messageTypeFilter" class="form-select w-25 ms-auto mb-2 mt-xxl-5"
                        aria-label="Default select example">
                        <option value="All">جميع الاستفسارات</option>
                        <option value="student">الطلاب</option>
                        <option value="consultant">المستشارين</option>
                        <option value="housing">السكن</option>
                        <option value="financing">التمويل</option>
                        <option value="transportation">النقل</option>
                        <option value="visitor">الزوار</option>
                    </select>
                    <table id="tableID" class="display nowrap consultant-container">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الالكتروني</th>
                                <th>الرسالة</th>
                                <th>الرد</th>
                                <th>تاريخ الإرسال</th>
                                <th>الاجرائات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            @foreach ($contacts ?? [] as $contact)
                                <tr data-type="{{ $contact->message_type }}">
                                    <td class="pe-3">{{ $counter }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ Str::limit($contact->message, 20) }}</td>
                                    <td>{{ Str::limit($contact->reply, 20) ?? 'لم يتم الرد' }}</td>
                                    <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        {{-- <a href="#" class="btn btn-link pe-0" data-bs-toggle="modal"
                                            data-bs-target="#replyModal{{ $contact->id }}">
                                            <i class="fa-regular fa-pen-to-square text-warning"></i>
                                        </a> --}}
                                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link pe-0"
                                                onclick="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                                <i class="fa-regular fa-trash-can text-danger"></i>
                                            </button>
                                        </form>
                                        <a href="#" class="btn btn-link pe-0" data-bs-toggle="modal"
                                            data-bs-target="#replyModal{{ $contact->id }}">
                                            <i class="fa-regular fa-comment-dots text-success"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- reply Modal for each contact -->
                                <div class="modal fade chat-modal" id="replyModal{{ $contact->id }}" tabindex="-1"
                                    aria-labelledby="replyModalLabel{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="chat-header">
                                                {{ __('الرد على') }}
                                                <strong>{{ $contact->name }}</strong>
                                            </div>
                                            <div class="chat-body d-flex flex-column">
                                                <div class="chat-message sent">{{ $contact->message }}</div>
                                            </div>
                                            <form action="{{ route('contacts.reply', $contact->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-footer d-flex justify-content-start w-100">
                                                    <input type="text" id="replyInput{{ $contact->id }}"
                                                        class="form-control" style="width: 70%;" name="reply"
                                                        placeholder="اكتب ردك هنا...">
                                                    <button type="submit" class="btn"
                                                        id="sendReply{{ $contact->id }}">إرسال</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @php $counter++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table = $('#tableID').DataTable({
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

            // Filter by message type
            $('#messageTypeFilter').on('change', function() {
                var selectedType = $(this).val();

                if (selectedType === 'All') {
                    // Clear filter and show all rows
                    table.rows().every(function() {
                        $(this.node()).show();
                    });
                } else {
                    table.rows().every(function() {
                        var rowType = $(this.node()).data('type');
                        if (rowType == selectedType) {
                            $(this.node()).show();
                        } else {
                            $(this.node()).hide();
                        }
                    });
                    // table.column(4).search(selectedType).draw();
                }
                table.draw(false);
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
