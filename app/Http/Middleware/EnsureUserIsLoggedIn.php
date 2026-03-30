<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('logged_in') || session('logged_in') !== true) {
            return redirect('/recipes')->with('error', 'Please log in to access this page.');
        }
       
        return $next($request);
    }
    public function __construct()
{
    $this->middleware('demo.auth')->except(['index', 'show']);
}
}
