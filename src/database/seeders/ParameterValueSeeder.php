<?php

namespace Database\Seeders;

use App\Models\Parameter;
use App\Models\Product;
use Database\Factories\ParameterValueFactory;
use Faker\Generator;
use Illuminate\Database\Seeder;

class ParameterValueSeeder extends Seeder
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
        $parameters = Parameter::all();
        $products = Product::with(['categories', 'categories.parameters'])->get();
        $factory = ParameterValueFactory::new();

        /** @var Product $product */
        foreach ($products as $product) {
            $availableParameters = $product->categories->pluck('parameters')->flatten()->unique('id');
            $count = $faker->numberBetween(0, $availableParameters->count());
            $parametersForProduct = $faker->randomElements($availableParameters->all(), $count);

            $factory = $factory->product($product);

            foreach ($parametersForProduct as $parameter) {
                $factory->parameter($parameter)->create();
            }
        }
    }
}
