<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\FinancingCompany;
use App\Models\Housing;

class HomeController extends Controller
{
    public function index()
    {
        $consultants = Consultant::get();
        $houses = Housing::with('primaryPhoto')->get();
        $financings = FinancingCompany::get();
        return view('home', compact('consultants', 'houses', 'financings'));
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
