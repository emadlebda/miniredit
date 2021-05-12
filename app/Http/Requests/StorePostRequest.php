<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
