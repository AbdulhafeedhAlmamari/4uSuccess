<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Show the payment form
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(int $orderId = null)
    {
        if (!$orderId) {
            return redirect()->route('home')->with('error', 'لا يوجد طلبات للدفع');
        }
        $invoice = Invoice::where('reservation_request_id', $orderId)->first();
        if (!$invoice) {
            // $invoice = Installment::where('finance_request_id', $orderId)->first();
            $invoice = Invoice::where('installment_id', $orderId)->first();
        }
        $amount = $invoice->amount_invoice; // Default amount
        // If invoice_id is provided, get the actual amount from the invoice
        if (!$invoice) {
            return redirect()->route('home')->with('error', 'لا يوجد  طلبات للدفع');
        }
        $invoice = Invoice::find($invoice->id);

        if ($invoice) {
            $vat = $invoice->vat  ?? 73.00;
            $amount = $invoice->amount_invoice;
            $serviceFee = $invoice->service_fee ?? 0;
            $vatCulc = ($invoice->vat ?? 0) / 100;
            $totalAmount = ($amount + $serviceFee) * (1 + $vatCulc);
        }
        return view('payment', compact('amount', 'vat', 'totalAmount', "serviceFee", 'invoice'));
    }


    /**
     * Process a payment using Stripe
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processPayment(Request $request)
    {
        // Check if we're confirming an existing payment intent
        if ($request->has('payment_intent_id')) {
            return $this->confirmPaymentIntent($request->payment_intent_id);
        }

        // Validate the request
        $request->validate([
            'payment_method_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'invoice_id' => 'required|exists:invoices,id'
        ]);

        // dd($request->all());
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => round($request->amount * 100), // Convert to cents
                'currency' => "SAR",
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('home'),
                'metadata' => [
                    'user_id' => auth()->id(),
                    'invoice_id' => $request->invoice_id ?? null,
                ]
            ]);

            // Check if payment requires additional action
            if (
                $paymentIntent->status === 'requires_action' &&
                $paymentIntent->next_action->type === 'use_stripe_sdk'
            ) {
                dd($request->all());
                // Tell the client to handle the action
                return response()->json([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $paymentIntent->client_secret
                ]);
            } else if ($paymentIntent->status === 'succeeded') {
                // Payment succeeded, save to database
                $save = $this->savePaymentRecord($paymentIntent,  $request->invoice_id);

                session()->flash('success', 'تم عملية الدفع بنجاح');

                return response()->json([
                    'success' => true,
                    'payment_id' => $paymentIntent->id,
                    'invoice_id' => $save
                ]);
            } else {
                // Invalid status
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid PaymentIntent status: ' . $paymentIntent->status
                ]);
            }
        } catch (ApiErrorException $e) {
            // Log the error
            Log::error('Stripe API Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Payment Processing Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'An unexpected error occurred. Please try again.'
            ]);
        }
    }

    /**
     * Confirm a payment intent
     *
     * @param string $paymentIntentId
     * @return \Illuminate\Http\JsonResponse
     */
    private function confirmPaymentIntent($paymentIntentId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            $paymentIntent->confirm();

            if ($paymentIntent->status === 'succeeded') {
                // Get the invoice_id from metadata
                $invoiceId = $paymentIntent->metadata->invoice_id ?? null;

                // Save payment to database
                dd($paymentIntent);
                $save = $this->savePaymentRecord($paymentIntent, $invoiceId);

                return response()->json([
                    'success' => true,
                    'payment_id' => $paymentIntent->id,
                    'invoice_id' => $save
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Payment confirmation failed: ' . $paymentIntent->status
                ]);
            }
        } catch (ApiErrorException $e) {
            Log::error('Stripe API Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Save payment details to database
     *
     * @param \Stripe\PaymentIntent $paymentIntent
     * @param int|null $invoiceId
     * @return void
     */
    private function savePaymentRecord($paymentIntent, $invoiceId)
    {
        try {
            $payment =    Payment::create([
                'amount' => 100, // Convert from cents back to decimal
                'status' => $paymentIntent->status,
                'payment_id' => $paymentIntent->id,
                'payment_method' => 'card', // e.g., 'card'
                'user_id' => auth()->id(),
                'invoice_id' => $invoiceId,
                'date_payment' => now(),

            ]);

            // If there's an invoice, update its status
            if ($invoiceId) {
                $invoice = Invoice::find($invoiceId);
                // dd($invoice);
                if ($invoice) {
                    $invoice->status = 'paid';
                    $invoice->save();
                    if ($invoice->reservationRequest) {
                        $invoice->reservationRequest->update(['status' => 'paid']);
                    }
                    if($invoice->installment){
                        $invoice->installment->update(['status' => 'paid']);
                    }
                    // $invoice->financeRequest->update(['status' => 'paid']);
                }
            }

            return $payment;
        } catch (\Exception $e) {
            // Log the error but don't interrupt the user flow
            Log::error('Error saving payment record: ' . $e->getMessage());
        }
    }
}
