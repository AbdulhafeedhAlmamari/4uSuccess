@extends('layouts.app')
@section('title')
    {{ __('طريقة الدفع') }}
@endsection
@section('css')
    <link href="{{ asset('build/assets/css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/consultant.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/css/transport.css') }}" rel="stylesheet">
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            background-color: white;
            transition: box-shadow 150ms ease;
            s
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        #card-errors {
            color: #fa755a;
            text-align: right;
            font-size: 13px;
            margin-top: 8px;
        }

        .payment-method-selector {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method-selector:hover {
            border-color: #54B6B7 !important;
        }

        .payment-method-selector.selected {
            border-color: #54B6B7 !important;
            background-color: rgba(84, 182, 183, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="container  transport-payment-container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Payment Form -->
                <div id="payment-form-container">
                    <h4 class="mb-4">طريقة الدفع</h4>
                    <div class="d-flex justify-content-between p-2 rounded mb-3">
                        <div class="p-2 rounded mb-3 border w-50 me-3 payment-method-selector selected" data-method="card">
                            <input type="radio" name="paymentMethod" id="creditCard" checked>
                            <label for="creditCard">بطاقة إئتمان <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png"
                                    width="30"></label>
                        </div>
                        {{-- <div class="p-2 rounded mb-3 border w-50 payment-method-selector" data-method="paypal">
                            <input type="radio" name="paymentMethod" id="paypal">
                            <label for="paypal">باي بال <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg"
                                    width="30"></label>
                        </div> --}}
                    </div>

                    <form id="payment-form">
                        @csrf
                        <input type="hidden" id="invoice-id" value="{{ $invoice->id ?? '' }}">

                        <h5 class="mb-3">معلومات بطاقة الإئتمان</h5>

                        <!-- Stripe Elements Placeholder -->
                        <div class="mb-3">
                            <label for="card-element">بيانات البطاقة</label>
                            <div id="card-element" class="form-control">
                                <!-- Stripe Elements will be inserted here -->
                            </div>
                            <!-- Used to display form errors -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="cardholder-name" placeholder="الاسم على البطاقة"
                                required>
                            {{-- <input type="text" id="invoice-id" name="invoice_id" value="{{ $invoice->id ?? '' }}"> --}}
                        </div>

                        <h5 class="mb-3">ملخص الطلب</h5>
                        <ul class="list-group mb-3 ">
                            <li class="list-group-item d-flex justify-content-between">التكلفة
                                <span>{{ $amount ?? '50.00' }} ريال</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">الضريبة
                                <span>{{ $vat . '%' ?? '15%' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">رسوم الخدمة
                                <span>{{ '23.00' }} ريال</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between fw-bold">الإجمالي <span
                                    id="total-amount">{{ $totalAmount ?? '73.00' }} ريال</span>
                            </li>
                        </ul>

                        <button class="btn btn-gradient w-100 py-2">تأكيد الدفع</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('build/assets/js/scroll_cards.js') }}"></script>
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create a Stripe client
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
            // Create an instance of Elements
            const elements = stripe.elements();

            // Custom styling for the card Element
            const style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create a card Element and mount it to the div with id 'card-element'
            const cardElement = elements.create('card', {
                style: style
            });
            cardElement.mount('#card-element');

            // Handle real-time validation errors from the card Element
            cardElement.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission
            const form = document.getElementById('payment-form');
            const submitButton = document.getElementById('submit-button');
            const buttonText = document.getElementById('button-text');
            const spinner = document.getElementById('spinner');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Disable the submit button to prevent repeated clicks
                submitButton.disabled = true;
                buttonText.classList.add('d-none');
                spinner.classList.remove('d-none');

                const cardholderName = document.getElementById('cardholder-name').value;
                const invoiceId = document.getElementById('invoice-id').value;

                // Create a PaymentMethod
                stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: {
                        name: cardholderName,
                    },
                }).then(function(result) {
                    if (result.error) {
                        // Show error to your customer
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;

                        // Re-enable the submit button
                        submitButton.disabled = false;
                        buttonText.classList.remove('d-none');
                        spinner.classList.add('d-none');
                    } else {
                        // Send the PaymentMethod ID to your server
                        processPayment(result.paymentMethod.id, invoiceId);
                    }
                });
            });

            // Function to send the payment method ID to the server
            function processPayment(paymentMethodId, invoiceId) {
                // Get the total amount from the page
                const totalAmount = document.getElementById('total-amount').innerText;
                const amount = parseFloat(totalAmount.replace(/[^0-9.]/g, ''));

                // Send the payment information to your server
                fetch('/process-payment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            payment_method_id: paymentMethodId,
                            amount: amount,
                            invoice_id: invoiceId || null
                        })
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        if (data.requires_action) {
                            // Use Stripe.js to handle the required action
                            stripe.handleCardAction(data.payment_intent_client_secret)
                                .then(function(result) {
                                    if (result.error) {
                                        // Show error to your customer
                                        const errorElement = document.getElementById('card-errors');
                                        errorElement.textContent = result.error.message;

                                        // Re-enable the submit button
                                        submitButton.disabled = false;
                                        buttonText.classList.remove('d-none');
                                        spinner.classList.add('d-none');
                                    } else {
                                        // The card action has been handled
                                        // The PaymentIntent can be confirmed again on the server
                                        fetch('/process-payment', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                payment_intent_id: result.paymentIntent.id
                                            })
                                        }).then(function(confirmResult) {
                                            return confirmResult.json();
                                        }).then(handleServerResponse);
                                    }
                                });
                        } else {
                            handleServerResponse(data);
                        }
                    })
                    .catch(function(error) {
                        console.error('Error:', error);

                        // Handle fetch error
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = 'Network error. Please try again.';

                        // Re-enable the submit button
                        submitButton.disabled = false;
                        buttonText.classList.remove('d-none');
                        spinner.classList.add('d-none');
                    });
            }

            function handleServerResponse(data) {
                if (data.success) {
                    // Show the success message
                    window.location.href = '/';
                } else {
                    // Handle payment error
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = data.error || 'An error occurred during payment processing.';

                    // Re-enable the submit button
                    submitButton.disabled = false;
                    buttonText.classList.remove('d-none');
                    spinner.classList.add('d-none');
                }
            }

            // Handle payment method selection
            const paymentMethodSelectors = document.querySelectorAll('.payment-method-selector');
            paymentMethodSelectors.forEach(selector => {
                selector.addEventListener('click', function() {
                    // Remove selected class from all selectors
                    paymentMethodSelectors.forEach(s => s.classList.remove('selected'));
                    // Add selected class to clicked selector
                    this.classList.add('selected');
                    // Check the radio button
                    this.querySelector('input[type="radio"]').checked = true;
                });
            });
        });
    </script>
@endsection
