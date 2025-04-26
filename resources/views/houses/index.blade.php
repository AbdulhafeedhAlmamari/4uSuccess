@extends('layouts.app')
@section('title')
    {{ __('المساكن') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/house.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- houses section -->
    <section class="houses-section my-5 house-section">
        <div class="container my-5 ">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-6">
                    <p class="houses_header mb-5 h1">السكن الجامعي</p>
                </div>
                <div class="col-6">
                    <form action="{{ route('home.houses') }}" method="GET">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" placeholder="بحث عن سكن"
                                        value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit"
                                        id="button-addon2">ابحث</button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <select class="form-select form-select" name="distance" id="distance"
                                        onchange="this.form.submit()">
                                        <option value="">المسافة</option>
                                        <option value="5" {{ request('distance') == '5' ? 'selected' : '' }}>أقل من 5
                                            كم</option>
                                        <option value="10" {{ request('distance') == '10' ? 'selected' : '' }}>أقل من 10
                                            كم</option>
                                        <option value="15" {{ request('distance') == '15' ? 'selected' : '' }}>أقل من 15
                                            كم</option>
                                        <option value="20" {{ request('distance') == '20' ? 'selected' : '' }}>أقل من 20
                                            كم</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <select class="form-select form-select" name="price" id="price"
                                        onchange="this.form.submit()">
                                        <option value="">السعر</option>
                                        <option value="500" {{ request('price') == '500' ? 'selected' : '' }}>أقل من 500
                                            ريال</option>
                                        <option value="1000" {{ request('price') == '1000' ? 'selected' : '' }}>أقل من
                                            1000 ريال</option>
                                        <option value="1500" {{ request('price') == '1500' ? 'selected' : '' }}>أقل من
                                            1500 ريال</option>
                                        <option value="2000" {{ request('price') == '2000' ? 'selected' : '' }}>أقل من
                                            2000 ريال</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row g-2">
                @if (request('search') || request('distance') || request('price'))
                    <div class="col-12 mb-3">
                        <div class="alert alert-info d-flex justify-content-between align-content-center">
                            {{-- <div class=" "> --}}
                            <div>
                                <h5>نتائج البحث:</h5>
                                @if (request('search'))
                                    <span class="badge bg-primary me-2">البحث: {{ request('search') }}</span>
                                @endif
                                @if (request('distance'))
                                    <span class="badge bg-secondary me-2">المسافة: أقل من {{ request('distance') }}
                                        كم</span>
                                @endif
                                @if (request('price'))
                                    <span class="badge bg-success me-2">السعر: أقل من {{ request('price') }}
                                        ريال</span>
                                @endif
                            </div>
                            <a href="{{ route('home.houses') }}"
                                class="btn btn-primary  btn-outline-danger float-end w-auto">إلغاء
                                التصفية</a>
                            {{-- </div> --}}
                        </div>
                    </div>
                @endif

                @forelse ($houses as $house)
                    <div class="col-6">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-12">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            @if (isset($house->primaryPhoto))
                                                <img src="{{ asset($house->primaryPhoto->path) }}"
                                                    class="card-img-top h-100 w-100 rounded-start" alt="صورة السكن">
                                            @else
                                                <img src="{{ asset('images/default.jpeg') }}"
                                                    class="card-img-top h-100 w-100 rounded-start" alt="صورة السكن">
                                            @endif
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $house->address ?? 'عنوان غير متوفر' }}</h5>
                                                <p class="card-text">يبعد عنك {{ $house->distance_from_university ?? '؟' }}
                                                    كيلو</p>
                                                <p class="card-text">
                                                    <small class="text-muted">{{ $house->price ?? 'غير محدد' }} ريال
                                                        شهريًا</small>
                                                </p>
                                                <a href="{{ route('houses.show', $house->id) }}"
                                                    class="btn btn-primary form-control w-50">تفاصيل أكثر</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 ">
                        <div class="alert alert-danger text-center" role="alert">
                            لا توجد مساكن متاحة حاليًا.
                        </div>
                    </div>
                    <br> <br> <br> <br>
                    <br> <br> <br> <br>
                    <br> <br> <br> <br>
                    <br> <br> <br> <br>
                @endforelse
            </div>
        </div>
    </section>
@endsection
