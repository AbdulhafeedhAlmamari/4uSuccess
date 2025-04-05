<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // return view('guest');
        return view('home');
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
