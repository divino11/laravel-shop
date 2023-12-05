<?php

namespace Database\Seeders;

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
        $sizes = [
            'xs',
            's',
            'm',
            'l',
            'xl',
            'one size'
        ];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'name' => $size,
            ]);
        }
    }
}
