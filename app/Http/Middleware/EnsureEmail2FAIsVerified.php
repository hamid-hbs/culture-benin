<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmail2FAIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->two_factor_code) {
            return redirect()->route('two-factor.showVerifyForm');
        }

        return $next($request);
    }
}