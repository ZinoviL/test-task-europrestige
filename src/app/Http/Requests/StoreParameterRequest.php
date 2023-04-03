<?php

namespace App\Http\Requests;

use App\Models\Parameter;
use Illuminate\Validation\Rule;

class StoreParameterRequest extends UpdateParameterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['name'][] = Rule::unique(Parameter::class, 'name');

        return $rules;
    }
}
