<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('staff_id')) {
            return redirect()->route('login');
        }
    
        return $next($request);
    }
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Redirect to login page.
        }
    }
}
