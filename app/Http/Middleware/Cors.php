<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if(env('API_KEY') == $request->header('api_key')) {

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*') // https://www.mydomain.com
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        // }
        
        // 403 Forbidden
        return response()->view('errors/401');
    }
}
