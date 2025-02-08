<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        \Log::info("Started");
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*'); //make sure to replace with your frontend url
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
        \Log::info("Done");

        return $response;
    }
}
