<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property $url
 * @property $short
 * @property $expire
 * @property $commercial
 */
class EncodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'url' => 'required|url',
            'short' => 'nullable|regex:/[a-zA-Z0-9]+/',
            'expire' => 'nullable|date',
            'commercial' => 'nullable|boolean',
        ];
    }
}
