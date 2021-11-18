<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        $valid_token = 'Bearer '.env('API_TOKEN');
        if($token != $valid_token)
        {
            return response()->json('Unauthorized', 401);
        }
        return $next($request);
    }
}
