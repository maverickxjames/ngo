<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Step 1: Ask for referral
    public function referCodePage()
    {
        return view('auth.referral');
    }

    public function checkReferral(Request $request)
    {
        $request->validate([
            'referral_code' => 'required|exists:users,form_number',
        ], [
            'referral_code.exists' => 'यह कार्यकर्ता क्रमांक अमान्य है।',
        ]);

        return redirect()->route('register.form', $request->referral_code);
    }

    // Step 2: Show registration form
    public function showRegistrationForm($referral)
    {
        // return $referral;
        $referrer = User::where('form_number', $referral)->first();
        
        if(!$referrer) {
            return redirect()->route('register.referral')->withErrors(['referral_code' => 'यह कार्यकर्ता क्रमांक अमान्य है।']);
        }

        return view('auth.register', compact('referrer'));
    }

    // Step 3: Save user
public function store(Request $request, $referral)
{
    $request->validate([
        'form_number' => 'required|string|max:255|unique:users,form_number',
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'guardian_name' => 'required|string|max:255',
        'dob' => 'required|date',
        'gender' => 'required',
        'education' => 'nullable|string|max:255',
        'address' => 'required|string',
        'tehsil' => 'required|string',
        'district' => 'required|string',
        'state' => 'required|string',
        'phone' => 'required|numeric',
        'password' => 'required|confirmed|min:6',
        'profile_picture' => 'nullable|image|max:2048',
    ]);

    $referrer = User::where('referral_code', $referral)->firstOrFail();

    // ✅ Check if PIN is available in session
    $pin = session('pin');

    $pinData = null;
    if ($pin) {
        $pinData = \App\Models\ActivationPin::where('pin', $pin)
            ->whereNull('used_by')
            ->first();
    }

    // ✅ Create User
    $user = new User();
    $user->name = $request->name;
    $user->form_number = $request->form_number;
    $user->username = $request->username;
    $user->guardian_name = $request->guardian_name;
    $user->dob = $request->dob;
    $user->gender = $request->gender;
    $user->education = $request->education;
    $user->address = $request->address;
    $user->tehsil = $request->tehsil;
    $user->district = $request->district;
    $user->state = $request->state;
    $user->phone = $request->phone;
    $user->pan_number = $request->pan_number ?? null;
    $user->referral_code = strtoupper(uniqid('NGO'));
    $user->referred_by = $referrer->id;
    $user->password = Hash::make($request->password);

    // ✅ Set status based on PIN
    $user->status = $pinData ? 'active' : 'pending';

    // ✅ Store photo
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profiles', 'public');
        $user->profile_photo = $path;
    }

    $user->save();

    // ✅ If PIN exists → Mark as used
    if ($pinData) {
        $pinData->used_by = $user->id;
        $pinData->used_at = now();
        $pinData->status = 'used';
        $pinData->save();
    }

    // ✅ Clear session after use
    session()->forget(['pin', 'referral']);

    return redirect()->route('login')->with('success', 'Registration successful! Please login.');
}

}
