<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'referral_code' => ['required', 'exists:users,referral_code,status,active'],
        ]);

        $inviter = User::where('referral_code', $request->referral_code)->first();
        
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
        $request->validate([
            'mpin' => ['required', 'digits_between:4,6'],
        ]);

        $user = Auth::user();
        if (!$user || !Hash::check($request->mpin, $user->mpin)) {
            // implement rate limiting and lockout logic
            return back()->withErrors(['mpin' => 'Invalid MPIN']);
        }
        // MPIN verified; redirect to dashboard
        return redirect()->intended('/');
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
}
