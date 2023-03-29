<?php

namespace App\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;

class GetJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->add(['accept' => 'application/json']);
        return $next($request);
    }
}