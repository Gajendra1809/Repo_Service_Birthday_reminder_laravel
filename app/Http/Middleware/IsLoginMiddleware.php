<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLoginMiddleware
{
    /**
     * Handle an incoming request.
     * Checking user logged in or not auth
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()){
        return $next($request);
        }
        return redirect(route("login"))->with("error","Please Login first!");
    }
}
