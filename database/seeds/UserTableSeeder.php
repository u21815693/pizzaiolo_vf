<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nom' => 'admin',
            'prenom' => 'admin',
            'type' => 'admin',
            'login' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'nom' => 'pizzaiolo',
            'prenom' => 'pizzaiolo',
            'type' => 'pizzaiolo',
            'login' => 'pizzaiolo',
            'password' => Hash::make('pizzaiolo'),
        ]);
    }
}
