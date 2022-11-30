<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'email'=>'GeneralVoyages@gmail.com',
            'password'=>Hash::make('General@147voyages'),
            'phone_number'=>"+237 653453458",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Buca voyages',
            'headquarters'=>'douala',
            'logo'=>"public/logo/buca.jpeg",
            'email'=>'BucaVoyage45@gmail.com',
            'password'=>Hash::make('Buca34voyages'),
            'phone_number'=>"+237 689476334",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Touristique Express',
            'headquarters'=>'douala',
            'logo'=>"public/logo/touristiques.jpeg",
            'email'=>'TourExpress@gmail.com',
            'password'=>Hash::make('AdminTour1233ZO'),
            'phone_number'=>"+237 674542333",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'United Express',
            'headquarters'=>'yaounde',
            'logo'=>"public/logo/united.png",
            'email'=>'UnitedExpress@gmail.com',
            'password'=>Hash::make('ExpressUnit34ZETY'),
            'phone_number'=>"+237 663449924",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Global voyages',
            'headquarters'=>'yaounde',
            'logo'=>"public/logo/global.jpeg",
            'email'=>'GlobalVoyages@gmail.com',
            'password'=>Hash::make('GlobalDomainVoyages@147'),
            'phone_number'=>"+237 635424752",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Fitness voyages',
            'headquarters'=>'douala',
            'logo'=>"public/logo/fitness.jpeg",
            'email'=>'FitnessVOyage86@gmail.com',
            'password'=>Hash::make('FitVoyage466DGG'),
            'phone_number'=>"+237 693263552",
            'state'=>1
         ]);
    }
}
