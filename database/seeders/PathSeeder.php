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
            'departure'=>"douala",
            'arrival'=>"yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"yaoundé",
            'arrival'=>"douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"douala",
            'arrival'=>"Bafoussam",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Bafoussam",
            'arrival'=>"yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Bafoussam",
            'arrival'=>"douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"yaoundé",
            'arrival'=>"Bafoussam",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"douala",
            'arrival'=>"Dshang",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Dshang",
            'arrival'=>"yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Dshang",
            'arrival'=>"douala",
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
            'arrival'=>"douala",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"douala",
            'arrival'=>"Foumban",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumban",
            'arrival'=>"yaoundé",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"Foumban",
            'arrival'=>"Dshang",
            'state'=>1,
         ]);

         DB::table('paths')->insert([
            'departure'=>"yaoundé",
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
    }
}
