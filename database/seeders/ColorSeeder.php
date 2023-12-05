<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'Красный',
                'hex_code' => '#ff3d3d',
            ],
            [
                'name' => 'Желтый',
                'hex_code' => '#ffdf3d',
            ],
            [
                'name' => 'Синий',
                'hex_code' => '#3d91ff',
            ],
            [
                'name' => 'Белый',
                'hex_code' => '#faffe5',
            ],
            [
                'name' => 'Черный',
                'hex_code' => '#000000',
            ],
        ];

        foreach ($colors as $color) {
            DB::table('colors')->insert([
                'name' => $color['name'],
                'hex_code' => $color['hex_code'],
            ]);
        }
    }
}
