<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryProductFactory extends Factory
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
     * Populate product to model
     *
     * @param Product $product
     * @return CategoryProductFactory
     */
    public function product(Product $product): CategoryProductFactory
    {
        return $this->state(function (array $attributes) use ($product) {
            return [
                'product_id' => $product->id,
            ];
        });
    }

    /**
     * Populate category to model
     *
     * @param Category $category
     * @return CategoryProductFactory
     */
    public function category(Category $category): CategoryProductFactory
    {
        return $this->state(function (array $attributes) use ($category) {
            return [
                'category_id' => $category->id,
            ];
        });
    }
}
