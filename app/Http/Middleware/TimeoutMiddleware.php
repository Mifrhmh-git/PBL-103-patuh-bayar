<?php

namespace App\Http\Middleware;

use Closure;

class TimeoutMiddleware
{
    public function handle($request, Closure $next)
    {
        // Atur batas waktu
        $timeout = 90;

        // Membatasi waktu eksekusi PHP
        set_time_limit($timeout);

        return $next($request);
    }
}
