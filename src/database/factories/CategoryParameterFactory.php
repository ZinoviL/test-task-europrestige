<?php

namespace Database\Factories;

use App\Models\Parameter;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }

    /**
     * Populate parameter to model
     *
     * @param Parameter $parameter
     * @return CategoryParameterFactory
     */
    public function parameter(Parameter $parameter): CategoryParameterFactory
    {
        return $this->state(function (array $attributes) use ($parameter) {
            return [
                'parameter_id' => $parameter->id,
            ];
        });
    }

    /**
     * Populate category to model
     *
     * @param Category $category
     * @return CategoryParameterFactory
     */
    public function category(Category $category): CategoryParameterFactory
    {
        return $this->state(function (array $attributes) use ($category) {
            return [
                'category_id' => $category->id,
            ];
        });
    }
}
