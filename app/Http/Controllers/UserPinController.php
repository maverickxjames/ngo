<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivationPin;
use App\Models\User;

class UserPinController extends Controller
{
    public function index()
    {
        $pins = ActivationPin::where('assigned_to', auth()->id())->get();
        $available = $pins->where('status', 'unused')->count();
        $used = $pins->where('status', 'used')->count();

        return view('user.pins', compact('pins', 'available', 'used'));
    }

    // public function usePin($pin)
    // {
    //     $pinData = ActivationPin::where('pin', $pin)
    //                             ->where('status', 'unused')
    //                             ->where('assigned_to', auth()->id())
    //                             ->firstOrFail();

    //     return redirect()->route('register.form', ['pin' => $pin, 'ref' => auth()->user()->referral_code]);
    // }

public function usePin($pin)
{
    $pinData = ActivationPin::where('pin', $pin)
        ->whereNull('used_by')
        ->first();

    if (!$pinData) {
        return redirect()->back()->with('error', 'Invalid or already used PIN');
    }

    // Fetch referral code from assigned user
    $user = User::find($pinData->assigned_to);

    if (!$user) {
        return redirect()->back()->with('error', 'Referral user not found');
    }

    $referral = $user->referral_code;

    // Store in session
    session([
        'referral' => $referral,
        'pin'      => $pin
    ]);

    return redirect()->route('register.form', ['referral' => $referral]);
}

}
