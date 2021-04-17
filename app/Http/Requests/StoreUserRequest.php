<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Providers\EnglishConvertion;
use Illuminate\Http\Request;

class StoreUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'password' => 'required|min:6',
            'password-confirm' => 'same:password',
            'phone_number' => 'required|numeric|digits:11',
            'email' => 'email:rfc,dns|required|max:255|unique:users,email,' . $request->get('id')
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
            'phone_number' => $englishConvertion->convert($this->input('phone_number'))
        ]);
    }
}
