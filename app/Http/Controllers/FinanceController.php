<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Consultant;
use App\Models\FinancingCompany;
use App\Models\HousingCompany;
use App\Models\TransportationCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FinanceController extends Controller
{
    public function index()
    {
        $financingCompanies = FinancingCompany::all();
        return view('finances.index', compact('financingCompanies'));
    }

    public function show($id)
    {
        $financingCompany = FinancingCompany::findOrFail($id);
        return view('finances.show', compact('financingCompany'));
    }

    public function createOrder($id)
    {
        $financingCompany = FinancingCompany::findOrFail($id);
        return view('finances.order', compact('financingCompany'));
    }
}
