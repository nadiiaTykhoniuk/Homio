<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRefugee extends FormRequest
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
            'name' => 'sometimes|string|min:1|max:50',
            'email' => 'nullable|string|min:1|max:50|unique:users,email',
            'phone' => 'sometimes|string|min:1|max:15',
            'additional_phone' => 'nullable|string|min:1|max:15',
            'moved_from_city' => 'nullable|string|min:1|max:50',
            'moved_to_city' => 'nullable|string|min:1|max:50'
        ];
    }
}
