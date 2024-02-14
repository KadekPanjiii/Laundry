<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Kasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && (auth()->user()->isKasir() || auth()->user()->isAdmin())) {
            return $next($request);
        }

        return abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    }
}
