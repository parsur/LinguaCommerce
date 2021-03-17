<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeSettingRequest;
use App\Providers\SuccessMessages;
use App\Models\Setting;


class HomeController extends Controller
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
            'fourthEventUrl'
        ];

        $home_settings = Setting::whereIn('name', $names)->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $vars["setting_$setting->name"] = $setting->value;
        }

        return view('setting.home',$vars);
    }

    // Store data
    public function store(StoreHomeSettingRequest $request,SuccessMessages $message) {
        // Header
        $home_setting = Setting::where('name', 'header')->select('value')->first();
        $home_setting->value = $request->get('header');
        $home_setting->save();
        
        // Sub header
        $home_setting2 = Setting::where('name','subHeader')->select('value')->first();
        $home_setting2->value = $request->get('subHeader');
        $home_setting2->save();

        // Description
        $home_setting3 = Setting::where('name','description')->select('value')->first();
        $home_setting3->value = $request->get('description');
        $home_setting3->save();

        // First event
        $home_setting5 = Setting::where('name', 'firstEvent')->select('value')->first();
        $home_setting5->value = $request->get('firstEvent');
        $home_setting5->save();
        
        // First event url
        $home_setting6 = Setting::where('name', 'firstEventUrl')->select('value')->first();
        $home_setting6->value = $request->get('firstEventUrl');
        $home_setting6->save();

        // Second event
        $home_setting6 = Setting::where('name', 'secondEvent')->select('value')->first();   
        $home_setting6->value = $request->get('secondEvent'); 
        $home_setting6->save();

        // Second event url
        $home_setting8 = Setting::where('name', 'secondEventUrl')->select('value')->first();
        $home_setting8->value = $request->get('secondEventUrl');
        $home_setting8->save();

        // Third event
        $home_setting9 = Setting::where('name', 'thirdEvent')->select('value')->first();
        $home_setting9->value = $request->get('thirdEvent');
        $home_setting9->save();

        // Third event url
        $home_setting10 = Setting::where('name', 'thirdEventUrl')->select('value')->first();
        $home_setting10->value = $request->get('thirdEventUrl');
        $home_setting10->save();

        // Fourth event
        $home_setting11 = Setting::where('name', 'fourthEvent')->select('value')->first();
        $home_setting11->value = $request->get('fourthEvent');
        $home_setting11->save();

        // Fourth event url
        $home_setting12 = Setting::where('name', 'fourthEventUrl')->select('value')->first();
        $home_setting12->value = $request->get('fourthEventUrl');
        $home_setting12->save();

        $success_output = $message->getInsert();
        $output = array('success' => $success_output);

        return response()->json($output);
    }
}
