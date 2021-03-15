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
        $home_settings = HomeSetting::whereIn('name', $names)->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $setting["setting_$setting->name"] = $setting->value;
        }

        return response()->json($vars);
    }

    // Search
    public function search(Action $action,Request $request) {
        // If search is requested
        if($request->get('courses')) {
            $action->search(Course::class, $request->get('courses'), 'name');
        } 
        else if($request->get('articles')) { 
            $action->search(Article::class, $request->get('articles'), 'title');
        }
    }
}
