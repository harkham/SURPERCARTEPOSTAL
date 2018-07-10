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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string|require',
            'message' => 'string|require',
            'latitude' => 'numeric|require',
            'longitude' => 'numeric|require',
            'medias' => 'array',
            'data' => 'in_array:medias|string',
            'description' => 'in_array:medias|string',
            'type' => 'in_array:medias|numeric'
        ];
    }
}
