<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
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
          'name' => 'Admin',
          'email' => 'admin@gmail.com',
          'role' => 'admin',
          'password' => Hash::make('123456789'),
          'phone' => '',
          'city'=>'',
          'address' =>'',
        ]);


    }
}
