<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
            ],
            'synopsis' => [
                'required',
                'string',
            ],
            'front_page' => [
                'image',
            ],
            'age_id' => [
                'required',
                'integer',
            ],            
            'state_id' => [
                'required',
                'integer',
            ],
            'type_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
