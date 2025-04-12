<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light nav_bg_cutom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('build/assets/images/footer.png') }}" alt="" class="d-inline-block align-text-top">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" aria-current="page"
                        href="{{ route('home') }}">الرئيسية</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        الخدمات
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('home.houses') }}">السكن</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('home.consultants.consultation_request') }}">التمويل</a></li>
                        <li><a class="dropdown-item" href="{{ route('home.transports') }}">النقل</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        استشارة
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('home.consultants.consultation_request') }}">طلب
                                استشارة</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.student_orders') }}">طلباتي</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home.consultants*') ? 'active' : '' }}"
                        href="{{ route('home.consultants') }}">المستشارين</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about.us') ? 'active' : '' }}"
                        href="{{ route('about.us') }}">من نحن</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact.us') ? 'active' : '' }}"
                        href="{{ route('contact.us') }}">تواصل معنا</a>
                </li>
            </ul>
        </div>

        <!-- notification -->
        <!-- <div class="dropdown notification-container">
                                    <a class="notification" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-bell"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">اشعار</a></li>
                                        <li><a class="dropdown-item" href="#">اشعار</a></li>
                                        <li><a class="dropdown-item" href="#">اشعار</a></li>
                                    </ul> -->
        <!-- counter -->
        <!-- <span class="counter">3</span> -->
        <!-- </div> -->

        <!-- user logo -->
        @if (Auth::check())
            <div class="dropdown">
                <a class="user-logo" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span class="mx-3">{{ Auth::user()->name }}</span>
                    <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('build/assets/images/cons-1.jpg') }}"
                        alt="" class="">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    @if (Auth::user()->role == 'student')
                        <li><a class="dropdown-item" href="{{ route('dashboard.student_profile') }}">الملف الشخصي</a>
                        </li>
                    @elseif (Auth::user()->role == 'financing')
                        <li><a class="dropdown-item" href="{{ route('dashboard.finance_profile') }}">الملف
                                الشخصي</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.finances') }}">لوحة تحكم التمويل</a>
                        </li>
                    @elseif (Auth::user()->role == 'consultant')
                        <li><a class="dropdown-item" href="{{ route('dashboard.consultant_profile') }}">الملف
                                الشخصي</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.consultants') }}">لوحة تحكم المشتشار</a>
                        </li>
                    @elseif (Auth::user()->role == 'housing')
                        <li><a class="dropdown-item" href="{{ route('dashboard.house_profile') }}">الملف
                                الشخصي</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.houses') }}">لوحة تحكم السكن</a></li>
                    @elseif (Auth::user()->role == 'transportation')
                        <li><a class="dropdown-item" href="{{ route('dashboard.transportation_profile') }}">الملف
                                الشخصي</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.transportations') }}">لوحة تحكم
                                النقل</a>
                        </li>
                    @elseif (Auth::user()->role == 'admin')
                        {{-- <li><a class="dropdown-item" href="{{ route('dashboard.admin_profile') }}">الملف
                                الشخصي</a></li> --}}
                    @endif

                    @if (Auth::user()->role == 'admin')
                        <li><a class="dropdown-item" href="{{ route('dashboard.admin') }}">لوحة التحكم</a>
                        </li>
                    @endif

                    <li><a class="dropdown-item" href="{{ route('dashboard.student_orders') }}">طلباتي</a></li>

                    <li><a class="dropdown-item" href="{{ route('logout') }}">تسجيل خروج</a></li>
                </ul>
            </div>
        @else
            {{-- login --}}
            <div class="d-flex user-login">
                <a href="#" class="mx-3" type="submit" data-bs-toggle="modal"
                    data-bs-target="#loginModal">تسجيل
                    الدخول
                    <i class="fa fa-lock m-3"></i></a>
            </div>
        @endif
    </div>
</nav>
