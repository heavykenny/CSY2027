<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorAuthenticate
{
    /**
     *  This middleware checks if the user is logged in and is a vendor or admin
     *  if not, it redirects the user to the login page
     *
     *  This is a very important middleware as it is used in all the admin and vendor routes
     */

    public function handle(Request $request, Closure $next)
    {
        // check if the user is logged in and is a vendor or admin
        if (Auth::check() && Auth::user()->vendor_id != null || Auth::user()->role->name == "admin") {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
