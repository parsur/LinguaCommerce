<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAuthentication 
{
    /**
     * Redirect User After Login
     * 
     * @return page
     */
    public function redirectTo() {
        // Get Authentication Role
        $role = Auth::user()->role; 
        // Admin Or User
        switch ($role) {
          case 'admin':
            return '/adminHome';
            break;
          case 'user':
            return '/user_dashboard';
            break; 
        }
    }
}
