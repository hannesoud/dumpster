<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContainerPost extends FormRequest
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
            'name' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'image' => 'required|image|max:512'
        ];
    }
}
