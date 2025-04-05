<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function index()
    {
        return view('dashboards.finances.index');
    }

    public function show()
    {
        return view('dashboards.finances.show');
    }

    public function orders()
    {
        return view('dashboards.finances.orders');
    }

    public function profile()
    {
        return view('dashboards.finances.profile');
    }
}
