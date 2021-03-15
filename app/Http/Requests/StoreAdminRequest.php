<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Providers\EnglishConvertion;
use Illuminate\Http\Request;

class StoreAdminRequest extends FormRequest
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
            'name' => 'required|string',
            'password' => 'required|min:6|',
            'password-confirm' => 'same:password',
            'phone_number' => 'nullable|numeric|digits:11',
            'email' => 'email:rfc,dns|required|max:255|unique:users,email,' . $request->get('id')
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'password-confirm' => "تاییدیه رمز عبور",
            'phone_number' => 'تلفن همراه'
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
