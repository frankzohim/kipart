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
            'logo'=>"logo/generalVoyages.jpeg",
            'email'=>'GeneralVoyages@gmail.com',
            'password'=>bcrypt('General@147voyages'),
            'phone_number'=>"+237 653453458",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Buca voyages',
            'headquarters'=>'douala',
            'logo'=>"logo/buca.jpg",
            'email'=>'BucaVoyage45@gmail.com',
            'password'=>bcrypt('Buca34voyages'),
            'phone_number'=>"+237 689476334",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Touristique Express',
            'headquarters'=>'douala',
            'logo'=>"logo/touristiques.jpeg",
            'email'=>'TourExpress@gmail.com',
            'password'=>bcrypt('AdminTour1233ZO'),
            'phone_number'=>"+237 674542333",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'United Express',
            'headquarters'=>'yaounde',
            'logo'=>"logo/united.jpg",
            'email'=>'UnitedExpress@gmail.com',
            'password'=>bcrypt('ExpressUnit34ZETY'),
            'phone_number'=>"+237 663449924",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Global voyages',
            'headquarters'=>'yaounde',
            'logo'=>"logo/global.jpeg",
            'email'=>'GlobalVoyages@gmail.com',
            'password'=>bcrypt('GlobalDomainVoyages@147'),
            'phone_number'=>"+237 635424752",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'Fitness voyages',
            'headquarters'=>'douala',
            'logo'=>"logo/fitness.png",
            'email'=>'FitnessVOyage86@gmail.com',
            'password'=>bcrypt('FitVoyage466DGG'),
            'phone_number'=>"+237 693263552",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'BUTSIS',
            'headquarters'=>'douala',
            'logo'=>"logo/butsis.jpeg",
            'email'=>'ButsisVoyage456@gmail.com',
            'password'=>bcrypt('BUTSIS4635'),
            'phone_number'=>"+237 65264552",
            'state'=>1
         ]);

         DB::table('agencies')->insert([
            'name'=>'MENTRAVEL',
            'headquarters'=>'douala',
            'logo'=>"logo/mentravel.jpeg",
            'email'=>'MENTRAVEL647@gmail.com',
            'password'=>bcrypt('MENTRAVEL74654'),
            'phone_number'=>"+237 69475434",
            'state'=>1
         ]);


    }
}
