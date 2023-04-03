<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Parameter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'parameters' => ['required', 'array'],
            'parameters.*' => ['integer', Rule::exists(Parameter::class, 'id')]
        ];
    }
}
