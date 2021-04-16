<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreWhyMeRequest;
use App\Models\Setting;

class WhyMeController extends Controller
{
    // 'Why me' page
    public function new() {

        $vars['whyMe'] = Setting::where('name', 'whyMe')->select('value')->first();
        return view('whyMe', $vars);
    }

    // Store data
    public function store(Request $request) {
        // Header
        $whyMe = Setting::where('name', 'whyMe')->first();
        $whyMe->value = $request->get('description');
        $whyMe->save();

        return $this->responseWithSuccess($this->getInsertionMessage());
    }

    // Show whyMe
    public function show() {
        $vars = Setting::where('name', 'whyMe')->select('value')->first();
        return response()->json($vars);
    }
}
