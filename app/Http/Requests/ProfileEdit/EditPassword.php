<?php

namespace App\Http\Requests\ProfileEdit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => [
                'required',
                'string',
                'min:8',
                'max:128',
                'confirmed'
            ],
            'current_password' => [
                'required',
                'string',
            ],
            'logout_others' => [
                'required'
            ]
        ];
    }
}
