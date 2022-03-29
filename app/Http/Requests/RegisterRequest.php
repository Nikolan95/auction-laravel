<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|min:4|max:100|unique:users',
            'firstname' => 'required|min:2|max:100',
            'lastname' => 'required|min:2|max:100',
            'email' => 'required|email|min:4|max:100|unique:users',
            'address' => 'required|min:2|max:100',
            'city' => 'required|min:2|max:100',
            'password' => 'required|min:5|required_with:confirm_password|same:confirm_password',
        ];
    }
}
