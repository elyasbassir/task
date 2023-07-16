<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\userlevel;
use Illuminate\Support\Facades\Auth;

class admin_access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user() && userlevel::admin == Auth::user()->level){
            return $next($request);
        }
        return redirect()->route('index');
    }
}
