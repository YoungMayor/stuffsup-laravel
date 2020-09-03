<?php

namespace App\Http\Requests\ProfileEdit;

use App\Providers\StateMapServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditLocation extends FormRequest
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
            'address' => [
                'required',
                'string',
                'min:3',
                'max:256'
            ],
            'city' => [
                'required',
                'string',
                'min:2',
                'max:256'
            ],
            'state' => [
                'required',
                Rule::in(array_keys(StateMapServiceProvider::$___state_map))
            ]
        ];
    }
}
