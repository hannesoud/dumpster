<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyPost extends FormRequest
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
            'web_site' => 'nullable|url|max:255',
            'license_number' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255|min:10',
            'avatar_image' => 'image|max:2024',
        ];
    }
}
