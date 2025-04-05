<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class HouseController extends Controller
{
    public function index()
    {
        return view('dashboards.houses.index');
    }

    public function show()
    {
        return view('dashboards.houses.show');
    }

    public function orders()
    {
        return view('dashboards.houses.orders');
    }

    public function profile()
    {
        return view('dashboards.houses.profile');
    }
}
