<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Bob',
            'email'=>'Bob237@gmail.com',
            'isVerifiedOtp'=>1,
            'password'=>bcrypt("password"),
            'phone_number'=>'690394365',
        ]);

        DB::table('users')->insert([
            'name'=>'Constantin',
            'email'=>'test@email.com',
            'isVerifiedOtp'=>1,
            'password'=>bcrypt("12345678"),
            'phone_number'=>'697864000',
        ]);
    }
}
