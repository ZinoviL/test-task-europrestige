<?php

namespace Database\Seeders;

use Database\Factories\ParameterFactory;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParameterFactory::new()->count(10)->create();
    }
}
