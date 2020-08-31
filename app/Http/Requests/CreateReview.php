<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateReview extends FormRequest
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
            'review'=> [
                'required',
                'string',
                'min:4',
                'max:1024'
            ],
            'rating'=> [
                'required',
                'numeric',
                'min:1.0',
                'max:5.0'
            ]
        ];
    }
}
