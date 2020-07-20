<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DecodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'url' => 'required|string',
        ];
    }
}
