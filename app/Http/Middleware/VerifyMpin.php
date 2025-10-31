<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyMpin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // ✅ If user is not logged in
        if (!$user) {
            return redirect()->route('login');
        }

        // ✅ If user account is pending activation — must use PIN first
        if ($user->status === 'pending' && !$request->routeIs('user.activate-pin*')) {
            return redirect()->route('user.activate-pin.form')
                ->with('warning', 'कृपया अपना खाता सक्रिय करने के लिए PIN दर्ज करें।');
        }

        // // ✅ If MPIN not verified yet - block all except MPIN page
        // if (!$request->session()->get('mpin_verified') && !$request->routeIs('mpin.*')) {
        //     return redirect()->route('mpin.verify.form')
        //         ->with('info', 'कृपया लॉगिन जारी रखने के लिए MPIN दर्ज करें।');
        // }

        return $next($request);
    }
}
