<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\FinancingCompany;
use App\Models\Housing;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $user = Auth::user();
    //     dd(Auth::check() && $user->is_approved !== '1');
    //     if (Auth::check() && $user->is_approved !== '1') {
    //         Auth::logout();
    //         return redirect()->route('home')->with('success', 'حسابك قيد المراجعة من قبل الإدارة');
    //     }
    // }
    public function index()
    {
        $consultants = Consultant::get();
        $houses = Housing::with('primaryPhoto')->get();
        $financings = FinancingCompany::get();
        if (Auth::check()) {
            return view('home', compact('consultants', 'houses', 'financings'));
        }
        return view('guest');
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

    // questions
    public function questions()
    {
        return view('questions');
    }
}
