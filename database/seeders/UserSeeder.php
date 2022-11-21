<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,10) as $index) {
            DB::table('users')->insert([
               'name'=>Str::random(10),
               'email'=>Str::random(10).'@gmail.com',
               'password'=>Str::random(10),
               'phone_number'=>Str::random(10),
            ]);
         }
    }
}
