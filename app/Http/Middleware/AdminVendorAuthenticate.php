<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorAuthenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->vendor_id != null || Auth::user()->role->name == "admin") {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
