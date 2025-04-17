<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Handle preflight (CORS OPTIONS) request
        if ($request->isMethod('OPTIONS')) {
            $response = response()->json(['status' => 'success'], 200);
            return $this->addCorsHeaders($response);
        }

        // Token validation
        $validToken = env('API_SECRET_KEY', 'your-default-secret-key');
        if ($request->bearerToken() !== $validToken) {
            $response = response()->json(['message' => 'Unauthorized'], 401);
            return $this->addCorsHeaders($response);
        }

        // Continue request
        $response = $next($request);
        return $this->addCorsHeaders($response);
    }

    /**
     * Add CORS headers to the response
     */
    private function addCorsHeaders(Response $response): Response
    {
        $response->headers->set('Access-Control-Allow-Origin', 'https://markazedurood.masjidehussain.com');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
