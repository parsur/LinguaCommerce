<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class HomeController extends Controller
{
    // App blade
    public function app() {
        return view('app');
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
            'fourthEventUrl'
        ];
        $home_settings = Setting::whereIn('name', $names)->select('value')->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $setting["setting_$setting->name"] = $setting->value;
        }

        return view('app', $vars);
    }

}
