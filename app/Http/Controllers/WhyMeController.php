<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreWhyMeRequest;
use App\Providers\SuccessMessages;
use App\Models\Setting;

class WhyMeController extends Controller
{
    // 'Why me' page
    public function new() {

        $vars['whyMe'] = Setting::where('name', 'whyMe')->select('value')->first();
        return view('whyMe', $vars);
    }

    // Store data
    public function store(Request $request,SuccessMessages $message) {
        // Header
        $whyMe = Setting::where('name', 'whyMe')->first();
        $whyMe->value = $request->get('description');
        $whyMe->save();

        $success_output = $message->getInsert();
        $output = array('success' => $success_output);

        return response()->json($output);
    }
}
