<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Earning;
use App\Models\Payout;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $pendingUsers = User::where('status', 'pending')->count();
        $totalDonations = Payment::where('status', 'success')->sum('amount');
        return view('admin.dashboard', compact('userCount', 'activeUsers', 'pendingUsers', 'totalDonations'));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:pending,active,rejected']);
        $user->status = $request->status;
        $user->save();
        return back()->with('status', 'User status updated');
    }

    public function payments()
    {
        $payments = Payment::latest()->paginate(20);
        return view('admin.payments', compact('payments'));
    }

    public function earnings()
    {
        $earnings = Earning::latest()->paginate(20);
        return view('admin.earnings', compact('earnings'));
    }

    public function payouts()
    {
        $payouts = Payout::latest()->paginate(20);
        return view('admin.payouts', compact('payouts'));
    }

    public function payOut(Request $request, User $user)
    {
        // sum unpaid earnings
        $amount = $user->earnings()->where('is_paid', false)->sum('amount');
        if ($amount <= 0) {
            return back()->withErrors(['payout' => 'No pending earnings for this user']);
        }
        // Mark earnings as paid
        $user->earnings()->where('is_paid', false)->update(['is_paid' => true]);
        // Create payout record
        Payout::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'bank_details_snapshot' => $user->bank_details,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
            'status' => 'paid',
        ]);
        return back()->with('status', 'Payout processed');
    }
}
