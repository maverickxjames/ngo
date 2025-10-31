<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\ActivationPin;

class AuthController extends Controller
{
    /**
     * Show registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'form_number' => ['required', 'numeric', 'unique:users,form_number'],
            'username'    => ['required', 'string', 'max:255', 'unique:users,username'],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
            'mpin'        => ['required', 'digits_between:4,6'],
            'referral_code' => ['required', 'exists:users,form_number,status,active'],
        ]);

        $inviter = User::where('form_number', $request->referral_code)->first();
        
        $user = User::create([
            'form_number' => $request->form_number,
            'username'    => $request->username,
            'password'    => Hash::make($request->password),
            'mpin'        => Hash::make($request->mpin),
            'profile_photo' => null, // handle upload separately
            'referral_code' => strtoupper(Str::random(8)),
            'referred_by'  => $inviter->id,
            'status'       => 'pending',
            'joined_at'    => now(),
        ]);

        // Trigger payment initiation (Razorpay by default)
        return redirect()->route('payment.callback', ['user' => $user->id]);
    }

    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login (username & password).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Ask for MPIN after password check
            return redirect()->route('mpin.verify.form');
        }
        return back()->withErrors(['username' => 'The provided credentials do not match our records.']);
    }

    /**
     * Verify MPIN after password login.
     */
public function verifyMpin(Request $request)
{
    // Ensure we have an array of digits
    $request->validate([
        'mpin_digits' => 'required|array|size:4',
        'mpin_digits.*' => 'required|digits:1',
    ]);

    // Convert array like ["1","2","3","4"] → "1234"
    $enteredMpin = implode('', $request->mpin_digits);

    $user = Auth::user();

    if (!$user || !Hash::check($enteredMpin, $user->mpin)) {
        // Optional: you can implement rate limiting or lockout logic here
        return back()->withErrors(['mpin' => 'Invalid MPIN entered.']);
    }

            // ✅ Mark session as MPIN-verified
        session(['mpin_verified' => true]);

    // ✅ MPIN verified successfully
    return redirect()->intended('/home')->with('status', 'MPIN verified successfully.');
}

    /**
     * Show MPIN verification form.
     */
    public function showMpinForm()
    {
        return view('auth.mpin');
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function showActivationPage()
{
    return view('auth.activate-pin'); // make this page
}

public function activatePin(Request $request)
{
    $request->validate([
        'pin_digits' => 'required|array|min:4|max:6'
    ]);

    $pin = implode('', $request->pin_digits);

    $pinData = ActivationPin::where('pin', $pin)
                ->whereNull('used_by')
                ->first();

    if (!$pinData) {
        return back()->withErrors(['pin' => 'अमान्य या पहले से उपयोग किया गया PIN']);
    }

    $user = Auth::user();
    $user->status = 'active';
    $user->save();

    $pinData->used_by = $user->id;
    $pinData->used_at = now();
    $pinData->status = 'used';
    $pinData->save();

    return redirect()->route('dashboard')
        ->with('success', 'आपका खाता सफलतापूर्वक सक्रिय हो गया ✅');
}


}
