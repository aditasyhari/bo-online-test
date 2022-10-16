<?php

namespace Database\Seeders;

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
        $this->call([
            JabatanSeeder::class,
            LevelSeeder::class,
            MenuSeeder::class,
            UserSeeder::class,
            DaerahSeeder::class,
        ]);
    }
}
