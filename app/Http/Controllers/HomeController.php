<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
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
        $home_settings = HomeSetting::whereIn('name', $names)->select('value')->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $setting["setting_$setting->name"] = $setting->value;
        }

        return response()->json($vars);
    }

}
