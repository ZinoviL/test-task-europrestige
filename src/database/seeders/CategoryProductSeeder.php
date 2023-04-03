<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Database\Factories\CategoryProductFactory;
use Faker\Generator;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /** @var Generator $faker */
        $faker = app(Generator::class);
        $products = Product::all();
        $categories = Category::all();
        $factory = CategoryProductFactory::new();

        foreach ($products as $product) {
            $count = $faker->numberBetween(0, $categories->count());
            $categoriesForProduct = $faker->randomElements($categories, $count);

            foreach ($categoriesForProduct as $category) {
                $factory
                    ->product($product)
                    ->category($category)
                    ->create();
            }
        }
    }
}
