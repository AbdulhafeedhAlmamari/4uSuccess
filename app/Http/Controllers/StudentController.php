<?php

namespace App\Http\Controllers;

class StudentController extends Controller
{
    public function index()
    {
        // return view('guest');
        return view('students.orders');
    }

    // countact_us
    public function contactUs()
    {
        return view('contact-us');
    }

    // countact_us
    public function aboutUs()
    {
        return view('about-us');
    }
}
