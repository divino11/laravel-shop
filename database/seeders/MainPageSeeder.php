<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_pages')->insert([
            'main_banner' => 'https://cdn.namelazz.com/media/cache/c7/b3/c7b3e46c0a5f0374a9f76e76c544472f.jpg',
            'main_banner_mobile' => 'https://cdn.namelazz.com/media/main/video/IMG_7706.MP4',
            'second_banner' => 'https://cdn.namelazz.com/media/main/video/IMG_7707_stojPRo.MP4',
            'second_banner_mobile' => 'https://cdn.namelazz.com/media/cache/71/31/7131085348f716e29a0edc04e7fac289.jpg',
            'third_banner' => 'https://cdn.namelazz.com/media/cache/06/1f/061f4baecada19534468f13448ac55de.jpg',
            'third_banner_mobile' => 'https://cdn.namelazz.com/media/cache/06/1f/061f4baecada19534468f13448ac55de.jpg',
        ]);
    }
}
