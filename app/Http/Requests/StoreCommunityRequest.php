<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommunityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:3|unique:communities',
            'description' => 'required|max:500',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
