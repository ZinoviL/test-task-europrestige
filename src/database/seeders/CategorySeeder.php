<?php

namespace Database\Seeders;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryFactory::new()->count(10)->create();
    }
}
