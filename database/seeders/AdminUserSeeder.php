<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('morkovka123'),
            'is_admin' => true
        ]);
    }
}
