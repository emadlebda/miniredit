<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'post_text' => ['string'],
            'post_url' => ['nullable', 'url']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
