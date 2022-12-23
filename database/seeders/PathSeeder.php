<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('paths')->insert([
            'departure'=>"Douala",
            'arrival'=>"Yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Yaoundé",
            'arrival'=>"Douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Douala",
            'arrival'=>"Bafoussam",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Bafoussam",
            'arrival'=>"Yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Bafoussam",
            'arrival'=>"Douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"yaoundé",
            'arrival'=>"Bafoussam",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Douala",
            'arrival'=>"Dshang",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Dshang",
            'arrival'=>"Yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Dshang",
            'arrival'=>"Douala",
            'state'=>1,
         ]);


         DB::table('paths')->insert([
            'departure'=>"Bafoussam",
            'arrival'=>"Dshang",
            'state'=>1,
         ]);


         DB::table('paths')->insert([
            'departure'=>"Dshang",
            'arrival'=>"Bafoussam",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumban",
            'arrival'=>"Douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Douala",
            'arrival'=>"Foumban",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumban",
            'arrival'=>"Yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumban",
            'arrival'=>"Dshang",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Yaoundé",
            'arrival'=>"Foumban",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Dshang",
            'arrival'=>"Foumban",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumban",
            'arrival'=>"Bafoussam",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Bafoussam",
            'arrival'=>"Foumban",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Douala",
            'arrival'=>"Kribi",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Kribi",
            'arrival'=>"Douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumbot",
            'arrival'=>"Douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumbot",
            'arrival'=>"Yaoundé",
            'state'=>1,
         ]);
         DB::table('paths')->insert([
            'departure'=>"Koutaba",
            'arrival'=>"Douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Mbouda",
            'arrival'=>"Douala",
            'state'=>1,
         ]);
         DB::table('paths')->insert([
            'departure'=>"Douala",
            'arrival'=>"Mbouda",
            'state'=>1,
         ]);
    }
}
