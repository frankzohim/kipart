<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            'hours'=>"05:00",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"06:00",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"07:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"08:30",
         ]);

         DB::table('schedules')->insert([
            'hours'=>"09:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"10:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"11:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"12:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"13:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"14:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"15:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"17:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"18:30",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"18:45",
         ]);
         DB::table('schedules')->insert([
            'hours'=>"19:30",
         ]);
    }
}
