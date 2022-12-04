<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'Admin',
            'email'=>'contact@Kipart.com',
            'email_verified_at' => now(),
            'password' => bcrypt("password"), // password
            'remember_token' => Str::random(10),
            'phone_number'=>"+237 74652442",
        ]);
    }
}
