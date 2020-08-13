<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSale extends FormRequest
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
            'title' => [
                'string',
                'min:8',
                'max:256',
                'required'
            ],
            'phone' => [
                'regex:/^(234|0)[7-9][01][0-9]{8}$/',
                'numeric',
                'required'
            ],
            'public_negotiation' => [
                'sometimes'
            ],
            'amount' => [
                'numeric',
                'min:0',
                'required'
            ],
            'description' => [
                'string',
                'min:12',
                'max:1024',
                'required'
            ],
            'category' => [
                'required'
            ],
            'location' => [
                'required',
                'array',
                'min:1'
            ],
            'location.*.state' => [
                'required'
            ],
            'location.*.region' => [
                'required',
                'string',
                'min:3',
                'max:128'
            ],
            'attachment' => [
                'required',
                'array',
                'min:1'
            ],
            'attachment.*.caption' => [
                'required',
                'string',
                'min:3',
                'max:128'
            ],
            'attachment.*.image' => [
                'required',
                'file',
                'image',
                'min:128',
                'max:1024',
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace('/[^0-9]+/', '', $this->phone)
        ]);
    }
}
