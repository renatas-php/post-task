<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth('sanctum')->user() && auth('sanctum')->user()->email === 'programuotojas.rene@gmail.com')
        {
            return $next($request);
        }
        return response()->json([
            'error' => 'Access denied',
        ]);
    }
}
