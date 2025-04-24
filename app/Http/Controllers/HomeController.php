<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\FinancingCompany;
use App\Models\Housing;

class HomeController extends Controller
{
    public function index()
    {
        $consultant = Consultant::get();
        $housings = Housing::get();
        $financing = FinancingCompany::get();
        // dd($consultant, $housings, $financing);
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
