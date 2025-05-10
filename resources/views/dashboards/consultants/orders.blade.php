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

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-success {
            background-color: #28a745;
            color: #fff;
        }

        .badge-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .badge-info {
            background-color: #17a2b8;
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
                        <div class="table-title d-flex justify-content-lg-end align-items-center">
                            <div class="">
                                <h2 class="m-0">طلبات استشارة

                                    @if ($status == 'pending')
                                        <span>قيد الانتظار</span>
                                    @elseif($status == 'completed')
                                        <span>مكتملة</span>
                                    @elseif($status == 'rejected')
                                        <span>مرفوضة</span>
                                    @endif
                                </h2>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الطالب</th>
                                    <th>التخصص</th>
                                    <th>موضوع الإستشارة</th>
                                    <th>نوع الاستشارة</th>
                                    <th>حالة الطلب</th>
                                    <th>الاجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($consultationRequests as $index => $request)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $request->student->name }}</td>
                                        <td>{{ $request->specialization }}</td>
                                        <td>{{ $request->subject }}</td>
                                        <td>{{ $request->type }}</td>
                                        <td>
                                            @if ($request->status == 'pending')
                                                <div class="d-flex justify-content-start gap-1">
                                                    <!-- قبول -->
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#acceptModal{{ $request->id }}"
                                                        class="btn custom-success">قبول</a>
                                                    <!-- رفض -->
                                                    {{-- <a href="{{ route('consultation.request.reject', $request->id) }}"
                                                        class="btn custom-danger">رفض</a> --}}
                                                    <button type="button" class="btn custom-danger" data-bs-toggle="modal"
                                                        data-bs-target="#rejectModal{{ $request->id }}">رفض</button>

                                                </div>
                                            @else
                                                <span
                                                    class="badge badge-{{ $request->status_color }}">{{ $request->status_name }}</span>
                                            @endif
                                        </td>
                                        <td class="actions">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#orderModal{{ $request->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>


                                    <!-- Modal for Accept -->
                                    <div class="modal fade" id="acceptModal{{ $request->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('consultation.request.accept', $request->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">

                                                        <h5 class="modal-title">قبول الطلب</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div style="width: 90%; margin: auto">
                                                        <p> نص الطلب: {{ $request->description }}</p>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="response">الرد على الطلب:</label>
                                                            <textarea name="response" id="response" class="form-control" rows="4" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-secondary bg-danger text-white"
                                                            data-bs-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn custom-success">إرسال</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal for Reject -->
                                    <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('consultation.request.reject', $request->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">رفض الطلب</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div style="width: 90%; margin: auto">
                                                        <p>موضوع الاستشارة: {{ $request->subject }}</p>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="reply">سبب الرفض:</label>
                                                            <textarea name="reply" id="reply" class="form-control" rows="4" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn btn-secondary bg-danger text-white"
                                                            data-bs-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn custom-success">إرسال</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal for each request -->
                                    <div class="modal fade orders-section-modal" id="orderModal{{ $request->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="info-section d-flex justify-content-between">
                                                        <div class="text-start">
                                                            <div class="image-container d-flex align-items-center">
                                                                <img src="{{ asset('storage/' . $request->profile_image) }}"
                                                                    alt="{{ $request->student->profile_image ?? 'Profile Image' }}"
                                                                    class="me-3"
                                                                    style="width: 80px; height: 80px; border-radius: 8px;">
                                                                <h5 class="ms-3">
                                                                    {{ $request->student->name ?? 'لا يوجد' }}</h5>
                                                            </div>
                                                            {{-- <p class="text-muted mt-3"><strong>التخصص:</strong> {{ $request->specialization }}</p> --}}
                                                            <p class="text-muted"> <strong>الجامعة:</strong>
                                                                {{ $request->student->student->university_name ?? 'لا يوجد' }}
                                                            </p>
                                                            <p class="text-muted"> <strong>رقم الجوال:</strong>
                                                                {{ $request->student->student->student_phone_number ?? 'لا يوجد' }}
                                                            </p>
                                                            <p class="text-muted"> <strong>الرقم الجامعي:</strong>
                                                                {{ $request->student->student->university_number ?? 'لا يوجد' }}
                                                            </p>
                                                            <p class="text-muted"> <strong>الجنس:</strong>
                                                                {{ $request->gender ? 'ذكر' : 'أنثى' ?? 'لا يوجد' }}
                                                            </p>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h5>طلب رقم {{ $request->id }}</h5>
                                                            <p class="text-muted">تاريخ الطلب:
                                                                {{ $request->request_date }}
                                                            </p>
                                                            <p class="status-box">حالة الطلب:
                                                                @if ($request->status == 'pending')
                                                                    <span class="badge bg-warning">قيد الانتظار</span>
                                                                @elseif($request->status == 'accepted')
                                                                    <span class="badge bg-success">مقبول</span>
                                                                @elseif($request->status == 'rejected')
                                                                    <span class="badge bg-danger">مرفوضة</span>
                                                                @endif
                                                                {{-- class="badge badge-{{ $request->status_color }}">{{ $request->status }}</span> --}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="divider my-4"></div>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col-md-4">
                                                            <h6 class="fw-bold">معلومات الطلب</h6>
                                                            <p><strong>التخصص:</strong> {{ $request->specialization }}</p>
                                                            <p><strong>نوع الاستشارة:</strong> {{ $request->type }}</p>
                                                            <p><strong>موضوع الاستشارة:</strong> {{ $request->subject }}
                                                            </p>
                                                        </div>
                                                        @if ($request->status == 'rejected')
                                                            <div class="col-md-4">
                                                                <h6 class="fw-bold">سبب الرفض</h6>
                                                                <p>
                                                                    {{ $request->reply }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-danger text-white"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                    @if ($request->status == 'pending')
                                                        {{-- <a href="{{ route('consultation.request.accept', $request->id) }}"
                                                            class="btn custom-success">قبول</a>
                                                        <a href="{{ route('consultation.request.reject', $request->id) }}"
                                                            class="btn custom-danger">رفض</a> --}}
                                                        {{-- @elseif($request->status == 'accepted')
                                                        <a href="{{ route('consultation.request.complete', $request->id) }}"
                                                            class="btn btn-info">إكمال</a> --}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لا توجد طلبات استشارة حالية</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                },
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
