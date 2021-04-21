<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;

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
        if (!empty($request->get('description')) && !auth('sanctum')->check()) {
            return response()->json(['error' => 'برای نوشتن توضیحات، نخست وارد سایت بشوید'], Response::HTTP_BAD_REQUEST);
        }

        // if not, authenticate.
        return $next($request);
    }
}
