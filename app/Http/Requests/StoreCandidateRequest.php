<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCandidateRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'min_salary' => 'numeric|nullable',
            'max_salary' => 'numeric|nullable',
            'linkedin_url' => 'nullable',
            'cv' => 'nullable'
        ];

        return $rules;
    }
}
