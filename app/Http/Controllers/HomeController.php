<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use App\Models\User;
use Auth;
use Artisan;

class HomeController extends Controller
{
    // Home
    public function app() {
        return view('app');
    }

    // Show the home api.
    public function index() {
        // Home settings
        $names = [
            'header',
            'subHeader',
            'description',
            'firstEvent',
            'firstEventUrl',
            'secondEvent',
            'secondEventUrl',
            'thirdEvent',
            'thirdEventUrl',
            'fourthEvent',
            'fourthEventUrl',
            'footer'
        ];

        $home_settings = Setting::whereIn('name', $names)->select('name', 'value')->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $vars[$setting->name] = $setting->value;
        }

        // Authentication
        $vars['authentication'] = auth('sanctum')->check();

        return response()->json($vars);
    }

    // Cache
    public function cache() {
        Artisan::call('cache:clear');
        // return what you want
        return "Cache is cleared";
    }

}
