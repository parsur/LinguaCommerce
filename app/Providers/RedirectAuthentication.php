<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RedirectAuthentication 
{
    /**
     * Redirect User After Registeration
     * 
     * @return page
     */
    public function redirectTo() {
      if (Auth::guard()->check() === true) {
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
}
