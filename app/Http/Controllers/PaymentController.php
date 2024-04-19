<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string|unique:payment,payment_id',
            'amount' => 'required|string',
            'customer_email' => 'required|string|email',
            'payment_status' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $payment = Payment::create($request->all());

        return response()->json($payment, 201);
    }

    public function show(Payment $payment)
    {
        return $payment;
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_id' => 'string|unique:payment,payment_id,'.$payment->id.',id',
            'amount' => 'string',
            'customer_email' => 'string|email',
            'payment_status' => 'string',
            'payment_method' => 'string',
        ]);

        $payment->update($request->all());

        return response()->json($payment, 200);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json(null, 204);
    }
}
