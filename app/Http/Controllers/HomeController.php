<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    // Home
    public function app() {
        return view('app');
    }

    /**
     * Show the home api.
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
            'fourthEventUrl',
            'footer'
        ];
        $home_settings = Setting::whereIn('name', $names)->select('name', 'value')->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $vars[$setting->name] = $setting->value;
        }

        return json_encode($vars, JSON_UNESCAPED_UNICODE);
    }

}
