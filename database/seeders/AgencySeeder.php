<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agencies')->insert([
            'name'=>'General Voyages',
            'headquarters'=>'douala',
            'logo'=>"public/logo/logo_general_voyages.b1d0c0f.png",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Buca voyages',
            'headquarters'=>'douala',
            'logo'=>"public/logo/buca.jpeg",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Touristique Express',
            'headquarters'=>'douala',
            'logo'=>"public/logo/touristiques.jpeg",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'United Express',
            'headquarters'=>'yaounde',
            'logo'=>"public/logo/united.png",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Global voyages',
            'headquarters'=>'yaounde',
            'logo'=>"public/logo/global.jpeg",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Fitness voyages',
            'headquarters'=>'douala',
            'logo'=>"public/logo/fitness.jpeg",
            'state'=>1
         ]);
    }
}
