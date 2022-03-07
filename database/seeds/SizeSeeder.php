<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($size = 20; $size <= 50; $size++) {
            DB::table('sizes')->insert([
                'name' => $size,
            ]);
        }
    }
}
