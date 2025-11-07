<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPassword
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->get('admin_authenticated', false) === true) {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('intended', $request->fullUrl());
    }
}





