<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // gather earnings summary and referrals
        $directIncome = $user->earnings()->where('type', 'direct')->sum('amount');
        $teamIncome   = $user->earnings()->where('type', 'team')->sum('amount');
        $payments     = $user->payments;
        $payouts      = $user->payouts;
        $directMembers = $user->children()->with('children')->get();
        $totalDonation = $payments->sum('amount');
        $userStatus = $user->status;


        return view('dashboard.index', compact(
            'user',
            'directIncome',
            'teamIncome',
            'payments',
            'payouts',
            'directMembers',
            'totalDonation',
            'userStatus'
        ));
    }

    public function editBankDetails()
    {
        $user = Auth::user();
        return view('dashboard.bank', compact('user'));
    }

    public function updateBankDetails(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string',
            'ifsc'          => 'required|string',
            'account_holder'=> 'required|string',
        ]);
        $user = Auth::user();
        $user->update([
            'bank_details' => [
                'account_number' => $request->account_number,
                'ifsc'           => $request->ifsc,
                'account_holder' => $request->account_holder,
            ],
        ]);
        return back()->with('status', 'Bank details updated');
    }
}
