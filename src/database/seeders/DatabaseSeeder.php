<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new()
            ->password('admin')
            ->create(['email' => 'admin@admin.admin']);

        $this->call([
            ParameterSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CategoryProductSeeder::class,
            CategoryParameterSeeder::class,
            ParameterValueSeeder::class,
        ]);
    }
}
