<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'type' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'pizzaiolo',
            'last_name' => 'pizzaiolo',
            'type' => 'pizzaiolo',
            'email' => 'pizzaiolo@gmail.com',
            'password' => Hash::make('pizzaiolo'),
        ]);
    }
}
