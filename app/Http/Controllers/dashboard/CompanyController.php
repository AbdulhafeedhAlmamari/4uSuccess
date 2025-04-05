<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        return view('dashboards.companies.index');
    }

    public function show()
    {
        return view('dashboards.companies.show');
    }

    public function orders()
    {
        return view('dashboards.companies.orders');
    }


    public function profile()
    {
        return view('dashboards.companies.profile');
    }
}
