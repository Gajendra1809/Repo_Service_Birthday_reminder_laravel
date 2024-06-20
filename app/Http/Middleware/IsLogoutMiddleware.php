<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLogoutMiddleware
{
    /**
     * Handle an incoming request.
     * Checking user logged out or not auth
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()){
        return $next($request);
        }
        return redirect(route("home"))->with("error","Please logout first!");
    }
}
