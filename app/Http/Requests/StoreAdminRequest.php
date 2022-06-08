<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'username' => 'required|string|min:4|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'contact' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.unique' => 'Username sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
            'contact.regex' => 'Nomor tidak sesuai',
        ];
    }
}
