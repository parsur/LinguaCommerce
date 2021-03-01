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
            'image'
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
        // Image
        if($request->hasFile("image")) {
            $image = $request->file('image');
            $file = $image->getClientOriginalName();
            $image->move(public_path('images'), $file);

            $home_setting4 = HomeSetting::where('name', 'description')->first();
            $home_setting4->value = $file;
            $home_setting4->save();
        }

        $success_output = $message->getInsert();
        $output = array('success' => $success_output);

        return response()->json($output);
    }

}
