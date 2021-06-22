<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'aparat_url' => 'required|regex:/^https?:\/\/www\.aparat\.com\/video\/video\/embed/',
            'course' => 'required'
        ];
    }

}
