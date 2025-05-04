@extends('layouts.app')

@section('title')
    {{ __('تفاصيل الاقساط') }}
@endsection
@section('css')
    {{-- css style --}}
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .table th {
            background-color: #e9ecef;
        }

        .badge-paid {
            background-color: #17a2b8;
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
    <div class="container mt-5">
        <div class="card p-4">
            <h3 class="card-title">التفاصيل</h3>

            <table class="table text-center table-bordered">
                <tbody>
                    <tr>
                        <th>المبلغ الرئيسي</th>
                        <td>{{ number_format($totalAmount, 2) ?? 0 }} ريال</td>
                        <th>المبلغ المستحق</th>
                        <td> {{ number_format($installments->first()->amount, 2) ?? 0 }} ريال</td>
                    </tr>
                    <tr>
                        <th>المبلغ المدفوع</th>
                        <td>{{ number_format($paidAmount, 2) ?? 0 }} ريال</td>
                        <th>الأقساط</th>
                        <td>
                            {{ $installmentProgress ?? 0 }}
                        </td>
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
                        <th>الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($installments as $installment)
                        <tr>
                            <td>{{ $installment->name }}</td>
                            <td>{{ number_format($installment->amount, 2) }} ريال</td>
                            <td>{{ $installment->due_date->format('d F Y') }}</td>
                            <td>
                                @if ($installment->status == 'paid')
                                    <span class="badge-paid">تم الدفع</span>
                                @else
                                    <span class="badge-unpaid">لم يتم الدفع</span>
                                @endif
                            </td>
                            <td>
                                @if ($installment->status == 'paid')
                                    -
                                @else
                                    <a href="{{ route('payment', $installment->id) }}">
                                        <i class="fa-brands fa-paypal"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- <!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>السكن</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- css Stylesheet -->
    <link href="../css/welcome.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <!-- icons -->
    <link href="../css/icons.min.css" rel="stylesheet" type="text/css" />


</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light nav_bg_cutom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../img/logo.jpeg" alt="" class="d-inline-block align-text-top">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="../home.html">الرئيسية</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            الخدمات
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="../houses/index.html">السكن</a></li>
                            <li><a class="dropdown-item" href="#">التمويل</a></li>
                            <li><a class="dropdown-item" href="#">النقل</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            استشارة
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item active" href="consultant_request.html">طلب استشارة</a></li>
                            <li><a class="dropdown-item" href="my_consultant_request.html">طلباتي</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">المستشارين</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="../about_us.html">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../countact_us.html">تواصل معنا</a>
                    </li>
                </ul>
            </div>
            <!-- notification -->
            <div class="dropdown notification-container">
                <a class="notification" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">اشعار</a></li>
                    <li><a class="dropdown-item" href="#">اشعار</a></li>
                    <li><a class="dropdown-item" href="#">اشعار</a></li>
                </ul>
                <!-- counter -->
                <span class="counter">3</span>
            </div>

            <!-- user logo -->
            <div class="dropdown">
                <a class="user-logo" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mx-3">ط/افنان الذيابي</span>
                    <img src="../img/logo.jpeg" alt="" class="">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">الملف الشخصي</a></li>
                    <li><a class="dropdown-item" href="#">طلباتي</a></li>
                    <li><a class="dropdown-item" href="#">تسجيل خروج</a></li>
                </ul>
            </div>

            <!-- <div class="d-flex">
                    <button class="btn btn-outline mx-3" type="submit">تسجيل الدخول</button>
                    <button class="btn btn" type="submit">إنشاء حساب</button>
                </div> -->
        </div>
    </nav>

    <br><br>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html> --}}
