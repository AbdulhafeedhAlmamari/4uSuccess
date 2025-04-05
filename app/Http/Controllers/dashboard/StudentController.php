<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboards.students.index');
    }

    public function show()
    {
        return view('dashboards.students.show');
    }

    public function orders()
    {
        return view('dashboards.students.orders');
    }

    public function profile()
    {
        return view('dashboards.students.profile');
    }
}
