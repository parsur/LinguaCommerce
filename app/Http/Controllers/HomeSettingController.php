<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreHomeSettingRequest;
use App\Providers\SuccessMessages;
use App\Models\HomeSetting;

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
            'fourthEventUrl'
        ];

        $home_settings = homeSetting::whereIn('name', $names)->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $vars["setting_$setting->name"] = $setting->value;
        }

        return view('homeSetting',$vars);
    }

    // Store data
    public function store(StoreHomeSettingRequest $request,SuccessMessages $message) {
        // Header
        $home_setting = HomeSetting::where('name', 'header')->first();
        $home_setting->value = $request->get('header');
        $home_setting->save();
        // Sub header
        $home_setting2 = HomeSetting::where('name','subHeader')->first();
        $home_setting2->value = $request->get('subHeader');
        $home_setting2->save();
        // Description
        $home_setting3 = HomeSetting::where('name','description')->first();
        $home_setting3->value = $request->get('description');
        $home_setting3->save();
        // First event
        $home_setting5 = HomeSetting::where('name', 'firstEvent')->first();
        $home_setting5->value = $request->get('firstEvent');
        $home_setting5->save();
        // First event url
        $home_setting6 = HomeSetting::where('name', 'firstEventUrl')->first();
        $home_setting6->value = $request->get('firstEventUrl');
        $home_setting6->save();
        // Second event
        $home_setting6 = HomeSetting::where('name', 'secondEvent')->first();   
        $home_setting6->value = $request->get('secondEvent'); 
        $home_setting6->save();
        // Second event url
        $home_setting8 = HomeSetting::where('name', 'secondEventUrl')->first();
        $home_setting8->value = $request->get('secondEventUrl');
        $home_setting8->save();
        // Third event
        $home_setting9 = HomeSetting::where('name', 'thirdEvent')->first();
        $home_setting9->value = $request->get('thirdEvent');
        $home_setting9->save();
        // Third event url
        $home_setting10 = HomeSetting::where('name', 'thirdEventUrl')->first();
        $home_setting10->value = $request->get('thirdEventUrl');
        $home_setting10->save();
        // Fourth event
        $home_setting11 = HomeSetting::where('name', 'fourthEvent')->first();
        $home_setting11->value = $request->get('fourthEvent');
        $home_setting11->save();
        // Fourth event url
        $home_setting12 = HomeSetting::where('name', 'fourthEventUrl')->first();
        $home_setting12->value = $request->get('fourthEventUrl');
        $home_setting12->save();

        $success_output = $message->getInsert();
        $output = array('success' => $success_output);

        return response()->json($output);
    }

}
