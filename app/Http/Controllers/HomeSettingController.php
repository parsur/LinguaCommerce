<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreHomeSettingRequest;
use App\Models\Setting;
use DB;


class HomeSettingController extends Controller
{
    // Show Setting Data
    public function new() {
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
            $vars["setting_$setting->name"] = $setting->value;
        }

        return view('homeSetting',$vars);
    }

    // Store data
    public function store(StoreHomeSettingRequest $request) {
        // Header
        $home_setting = Setting::where('name', 'header')->first();
        $home_setting->value = $request->get('header');
        $home_setting->save();
        
        // Sub header
        $home_setting2 = Setting::where('name','subHeader')->first();
        $home_setting2->value = $request->get('subHeader');
        $home_setting2->save();

        // Description
        $home_setting3 = Setting::where('name','description')->first();
        $home_setting3->value = $request->get('description');
        $home_setting3->save();

        // First event
        $home_setting5 = Setting::where('name', 'firstEvent')->first();
        $home_setting5->value = $request->get('firstEvent');
        $home_setting5->save();
        
        // First event url
        $home_setting6 = Setting::where('name', 'firstEventUrl')->first();
        $home_setting6->value = $request->get('firstEventUrl');
        $home_setting6->save();

        // Second event
        $home_setting6 = Setting::where('name', 'secondEvent')->first();   
        $home_setting6->value = $request->get('secondEvent'); 
        $home_setting6->save();

        // Second event url
        $home_setting8 = Setting::where('name', 'secondEventUrl')->first();
        $home_setting8->value = $request->get('secondEventUrl');
        $home_setting8->save();

        // Third event
        $home_setting9 = Setting::where('name', 'thirdEvent')->first();
        $home_setting9->value = $request->get('thirdEvent');
        $home_setting9->save();

        // Third event url
        $home_setting10 = Setting::where('name', 'thirdEventUrl')->first();
        $home_setting10->value = $request->get('thirdEventUrl');
        $home_setting10->save();

        // Fourth event
        $home_setting11 = Setting::where('name', 'fourthEvent')->first();
        $home_setting11->value = $request->get('fourthEvent');
        $home_setting11->save();

        // Fourth event url
        $home_setting12 = Setting::where('name', 'fourthEventUrl')->first();
        $home_setting12->value = $request->get('fourthEventUrl');
        $home_setting12->save();

        // Footer
        $home_setting13 = Setting::where('name', 'footer')->first();
        $home_setting13->value = $request->get('footer');
        $home_setting13->save();

        return $this->successfulResponse($this->getInsertionMessage());
    }
}
