<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
public function handle($request, Closure $next, $roles)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Support pipe-separated roles
    $roles = explode('|', strtolower($roles));

    if (!in_array(strtolower(Auth::user()->role), $roles)) {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}

}