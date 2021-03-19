<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class StoreConsultation
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
        // Check authentication and description
        if ($request->has('description') && !Auth::check()) {
            return redirect('login');
        }

        // if not, authenticate.
        return $next($request);
    }
}
