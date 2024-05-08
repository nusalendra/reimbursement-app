<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$jabatans): Response
    {
        if (auth()->check() && in_array(auth()->user()->jabatan, $jabatans)) {
            return $next($request);
        }

        switch (auth()->user()->jabatan) {
            case 'Direktur':
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
            case 'Finance':
                return redirect()->route('#')->with('error', 'You do not have permission to access this page.');
            case 'Staff':
                return redirect()->route('#')->with('error', 'You do not have permission to access this page.');
            default:
                return redirect('/')->with('error', 'You do not have permission to access this page.');
        }
    }
}
