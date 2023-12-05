<?php

namespace Database\Seeders;

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Пижама',
                'code' => 'pijama',
            ],
            [
                'name' => 'Новая колекция',
                'code' => 'new-collection',
            ],
            [
                'name' => 'Популярные товары',
                'code' => 'popular-products',
            ],
            [
                'name' => 'Распродажа',
                'code' => 'sales',
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'code' => $category['code'],
            ]);
        }
    }
}
