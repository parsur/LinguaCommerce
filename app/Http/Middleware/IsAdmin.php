<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class IsAdmin
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
        // Admin
        if(auth()->user()->role == User::ADMIN) {
            return $next($request);
        }

        // Forbidden message
        return response()->view('errors.403', ['exception' => 'شما اجازه دسترسی به این بخش را ندارید'], 403);
    }
}
