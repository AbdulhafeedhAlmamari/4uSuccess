<?php

namespace App\Http\Controllers;

use App\Models\FinanceRequest;
use App\Models\Installment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class InstallmentController extends Controller
{
    /**
     * Display the installment details for a finance request.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $financeRequest = FinanceRequest::with('installments')->findOrFail($id);

        // Check if user is authorized to view this finance request
        if (
            Auth::id() !== $financeRequest->student_id &&
            Auth::id() !== $financeRequest->financing_company_id
        ) {
            abort(403, 'Unauthorized action.');
        }

        // Check for overdue installments on page load
        foreach ($financeRequest->installments as $installment) {
            $installment->updateOverdueStatus();
        }

        // Refresh the finance request to get updated installments
        $financeRequest = FinanceRequest::with('installments')->findOrFail($id);
        $installments = $financeRequest->installments;

        return view('dashboards.students.installment', [
            'financeRequest' => $financeRequest,
            'installments' => $installments,
            'totalAmount' => $financeRequest->amount,
            'paidAmount' => $financeRequest->total_paid,
            'remainingAmount' => $financeRequest->remaining_amount,
            'installmentProgress' => $financeRequest->paid_installments_count . '/' . $financeRequest->installment_period
        ]);
    }



    /**
     * Update the status of an installment.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:paid,unpaid,overdue',
        ]);

        $installment = Installment::findOrFail($id);

        // Check if user is authorized to update this installment
        if (Auth::id() !== $installment->financeRequest->financing_company_id ) {
            abort(403, 'Unauthorized action.');
        }

        $oldStatus = $installment->status;
        $newStatus = $request->status;

        $installment->update([
            'status' => $newStatus
        ]);

        // If status changed to paid, update the finance request total_paid
        if ($oldStatus !== 'paid' && $newStatus === 'paid') {
            $financeRequest = $installment->financeRequest;
            $financeRequest->update([
                'total_paid' => $financeRequest->total_paid + $installment->amount
            ]);
        }

        // If status changed from paid to unpaid/overdue, update the finance request total_paid
        if ($oldStatus === 'paid' && $newStatus !== 'paid') {
            $financeRequest = $installment->financeRequest;
            $financeRequest->update([
                'total_paid' => $financeRequest->total_paid - $installment->amount
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث حالة القسط بنجاح');
    }

    /**
     * Check for overdue installments and update their status.
     * This can be called manually from a controller action instead of using a scheduler.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkOverdueInstallments()
    {
        $overdueInstallments = Installment::where('status', 'unpaid')
            ->where('due_date', '<', now())
            ->get();

        foreach ($overdueInstallments as $installment) {
            $installment->update(['status' => 'overdue']);
        }

        return redirect()->back()->with('success', 'تم تحديث حالة الأقساط المتأخرة');
    }
}
