<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Consultant;
use App\Models\FinanceRequest;
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'loanType' => 'required|string',
            'amountRequested' => 'required|numeric|min:1',
            'description' => 'required|string',
            'loanDuration' => 'required|in:12,18,24,60',
            'termsCheck' => 'accepted',
            'termsAgreement' => 'accepted',
            'financing_company_id' => 'required',
            'iban' => 'required|numeric',
        ]);
        $financeRequest =  FinanceRequest::create(array_merge($validatedData, [
            'finance_type' => $request->loanType,
            'amount' => $request->amountRequested,
            'installment_period' => $request->loanDuration,
            'description' => $request->description,
            'is_agreed' => isset($request->termsAgreement) ? 1 : 0,
            'terms_and_conditions' => isset($request->termsAgreement) ? 1 : 0,
            'student_id' => $request->user()->id,
            'financing_company_id' => $request->financing_company_id,
            'iban' => $request->iban
        ]));
        if ($financeRequest) {
            return redirect()->back()->with('success', 'تم إرسال طلب التمويل بنجاح!');
        }
        return redirect()->back()->with('error', 'حدث خطأ أثناء إرسال طلب التمويل. يرجى المحاولة مرة أخرى.');
    }
}
