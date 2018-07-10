<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCardRequest extends FormRequest
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
            'title' => 'string|required',
            'message' => 'string|required',
            'latitude' => 'numeric|required',
            'longitude' => 'numeric|required',
            'medias' => 'array',
            'data' => 'in_array:medias|string|required',
            'description' => 'in_array:medias|string|required',
            'type' => 'in_array:medias|numeric|between:1,4|required'
        ];
    }
}
