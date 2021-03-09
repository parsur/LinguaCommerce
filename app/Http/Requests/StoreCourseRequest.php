<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Providers\EnglishConvertion;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'price' => 'nullable',
            'description' => 'required',
            'status' => 'required'
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
