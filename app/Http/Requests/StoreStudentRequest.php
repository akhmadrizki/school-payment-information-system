<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'nis' => 'required|regex:/^([0-9\s\(\)]*)$/|min:4|max:4|unique:students',
            'email' => 'required|email|unique:users',
            'whatsapp' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15|unique:students',
            'whatsapp_parent' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15',
            'study_program' => 'required|exists:study_programs,id',
            'grade' => 'required|exists:grades,id',
            'scholarship' => 'required|exists:scholarships,id',
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
            'nis.unique' => 'NIS sudah terdaftar',
            'nis.regex' => 'NIS harus berupa angka',
            'email.email' => 'Email tidak valid',
            'whatsapp.regex' => 'Nomor tidak sesuai',
            'whatsapp_parent.regex' => 'Nomor tidak sesuai',
        ];
    }
}
