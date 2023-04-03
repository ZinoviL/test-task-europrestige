<?php

namespace Database\Seeders;

use App\Models\Parameter;
use App\Models\Category;
use Database\Factories\CategoryParameterFactory;
use Faker\Generator;
use Illuminate\Database\Seeder;

class CategoryParameterSeeder extends Seeder
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
        $categories = Category::all();
        $parameters = Parameter::all();
        $factory = CategoryParameterFactory::new();

        foreach ($categories as $category) {
            $count = $faker->numberBetween(0, $parameters->count());
            $parametersForCategory = $faker->randomElements($parameters, $count);

            foreach ($parametersForCategory as $parameter) {
                $factory
                    ->parameter($parameter)
                    ->category($category)
                    ->create();
            }
        }
    }
}
