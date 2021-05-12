<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'post_url' => ['url']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
