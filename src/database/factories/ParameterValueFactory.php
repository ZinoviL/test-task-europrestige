<?php

namespace Database\Factories;

use App\Models\Parameter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParameterValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->word(),
        ];
    }

    /**
     * Populate parameter to model
     *
     * @param Parameter $parameter
     * @return ParameterValueFactory
     */
    public function parameter(Parameter $parameter): ParameterValueFactory
    {
        return $this->state(function (array $attributes) use ($parameter) {
            return [
                'parameter_id' => $parameter->id,
            ];
        });
    }

    /**
     * Populate product to model
     *
     * @param Product $product
     * @return ParameterValueFactory
     */
    public function product(Product $product): ParameterValueFactory
    {
        return $this->state(function (array $attributes) use ($product) {
            return [
                'product_id' => $product->id,
            ];
        });
    }
}
