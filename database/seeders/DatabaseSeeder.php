<?php

use Database\Seeders\ColorSeeder;
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
            //SizeSeeder::class,
            //AdminUserSeeder::class
            MainPageSeeder::class,
            ColorSeeder::class
        ]);
    }
}
