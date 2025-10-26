<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Handle payment callback from gateway.
     * In a real application, this would verify the payment signature and update statuses.
     */
    public function callback(Request $request)
    {
        // Example callback handling for Razorpay
        $paymentId = $request->input('razorpay_payment_id');
        $userId    = $request->input('user');

        $user = User::findOrFail($userId);

        // Create payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'gateway' => 'razorpay',
            'order_id' => $paymentId,
            'amount' => 600.00,
            'status' => 'success',
        ]);

        // Update user status and link activation_payment_id
        $user->update([
            'status' => 'active',
            'activation_payment_id' => $payment->id,
        ]);

        // Dispatch earnings calculation job (not implemented)
        // EarningsJob::dispatch($user);

        return redirect()->route('dashboard')->with('status', 'Activation successful!');
    }
}
