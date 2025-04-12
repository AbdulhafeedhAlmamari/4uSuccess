<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function guest()
    {
        return view('guest');
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

    // join_us
    public function joinUs()
    {
        return view('register-request');
    }
}
