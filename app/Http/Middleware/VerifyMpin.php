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

        // ✅ Skip if user is not logged in
        if (!$user) {
            return redirect()->route('login');
        }

        // ✅ If MPIN not verified yet, and route is not mpin page, block access
        if (!$request->session()->get('mpin_verified') && !$request->routeIs('mpin.*')) {
            return redirect()->route('mpin.verify.form');
        }

        return $next($request);
    }
}
