<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'whatsapp' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15',
            'whatsapp_parent' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15',
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
            'name.regex' => 'Nama tidak sesuai format',
            'email.email' => 'Email tidak valid',
            'whatsapp.regex' => 'Nomor tidak sesuai',
            'whatsapp_parent.regex' => 'Nomor tidak sesuai',
        ];
    }
}
