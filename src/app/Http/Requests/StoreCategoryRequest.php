<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends UpdateCategoryRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'][] = Rule::unique(Category::class, 'name');

        return $rules;
    }
}
