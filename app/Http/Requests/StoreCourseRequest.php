<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Providers\EnglishConvertion;

class StoreCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'required|max:120|unique:courses,id,' . $request->get('id'),
            'price' => 'nullable|numeric',
            'description' => 'required',
            'status' => 'required',
            'categories' => 'required'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // English convertion
        $englishConvertion = new EnglishConvertion();

        $this->merge([
            'price' => $englishConvertion->convert($this->input('price'))
        ]);
    }
}
