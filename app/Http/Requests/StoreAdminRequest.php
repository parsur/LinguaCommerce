<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'name' => 'required',
            'password' => 'nullable|min:6|',
            'password2' => 'same:password',
            'phone_number' => 'nullable|numeric|digits:11',
            'email' => 'required|unique:users,email,' . $request->get('id')
        ];
    }
}
