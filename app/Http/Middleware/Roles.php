<?php

namespace App\Http\Middleware;

use Closure;

class Roles
{
    /**
     * Function ini berfungsi untuk mengatur request berupa
     * validasi user.
     * 
     * Made by @stefanadisurya & @ChristopherIrvine
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if(in_array($request->user()->role,$roles)) {
            return $next($request);
        }
        return redirect()->route('login');
    }
}
