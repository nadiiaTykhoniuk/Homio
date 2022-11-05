<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'refugee_id' => 'sometimes|integer|exists:users,id',
            'worker_id' => 'sometimes|integer|exists:users,id',
            'title' => 'required|string',
            'description' => 'sometimes|string',
            'type' => 'sometimes|string|min:1|max:20',
            'status' => 'sometimes|string|min:1|max:20',
            'number_of_people' => 'sometimes|integer',
            'with_pets' => 'sometimes|boolean'
        ];
    }
}
