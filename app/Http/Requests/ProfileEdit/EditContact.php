<?php

namespace App\Http\Requests\ProfileEdit;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditContact extends FormRequest
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
            'name' => [
                'sometimes',
                'required',
                'string',
                'regex:/'.User::username_regex().'/',
                'min:4',
                'max:32',
                Rule::unique('App\User', 'name')->ignore(Auth::id()),
            ],
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                Rule::unique('App\User', 'email')->ignore(Auth::id())
            ],
            'first_name' => [
                'required',
                'string',
                'min:4',
                'max:32',
                'alpha'
            ],
            'last_name' => [
                'required',
                'string',
                'min:4',
                'max:32',
                'alpha'
            ],
            'password' => [
                'required_with:name,email',
                'string',
                'min:4',
                'max:128'
            ]
        ];
    }
}
