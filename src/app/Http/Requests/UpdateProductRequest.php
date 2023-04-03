<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Parameter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'parameter_values' => ['required', 'array'],
            'parameter_values.*.parameter_id' => [
                'required',
                'integer',
                Rule::exists(Parameter::class, 'id')
            ],
            'parameter_values.*.value' => ['required', 'string'],
        ];
    }
}
