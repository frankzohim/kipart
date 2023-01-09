<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubAgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_agencies')->insert([
            'name'=>'BUCA VOYAGES DOUALA',
            'localisation'=>'Douala',
            'email'=>'BucaVoyageDouala@gmail.com',
            'password'=>bcrypt('buca238@ghj'),
            'phone'=>'690457346',
            'agency_id'=>2
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'BUCA VOYAGES YAOUNDE',
            'localisation'=>'Yaoundé',
            'email'=>'Buca45YDE@gmail.com',
            'password'=>bcrypt('YdeBuca34'),
            'phone'=>'693476253',
            'agency_id'=>2
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'FINEX VOYAGES DOUALA',
            'localisation'=>'Douala',
            'email'=>'FinexDlA89@gmail.com',
            'password'=>bcrypt('finex560@YET'),
            'phone'=>'685344263',
            'agency_id'=>6
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'FINEX VOYAGES YAOUNDE',
            'localisation'=>'Yaoundé',
            'email'=>'FinexYDE86@gmail.com',
            'password'=>bcrypt('finexHSJD'),
            'phone'=>'678940743',
            'agency_id'=>6
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES AKWA',
            'localisation'=>'Douala',
            'email'=>'GeneralAkwa34@gmail.com',
            'password'=>bcrypt('1Y23RUETT'),
            'phone'=>'673653537',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES BEPANDA',
            'localisation'=>'Douala',
            'email'=>'GeneralVoyageBpd@gmail.com',
            'password'=>bcrypt('JDGS73625'),
            'phone'=>'677465345',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES BRAZZAVILLE',
            'localisation'=>'Douala',
            'email'=>'GeneralBraza23@gmail.com',
            'password'=>bcrypt('brazagen5@rjz'),
            'phone'=>'690673290',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES BONABERI',
            'localisation'=>'Douala',
            'email'=>'GeneBona347@gmail.com',
            'password'=>bcrypt('bonaGene92@df'),
            'phone'=>'690665425',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES YAOUNDE',
            'localisation'=>'Yaoundé',
            'email'=>'GeneralYde45@gmail.com',
            'password'=>bcrypt('ghrkz34@fj'),
            'phone'=>'657930233',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES DSCHANG',
            'localisation'=>'Dshang',
            'email'=>'GeneralDsg74@gmail.com',
            'password'=>bcrypt('ffyyr3762'),
            'phone'=>'689362536',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES BAFOUSSAM',
            'localisation'=>'Bafoussam',
            'email'=>'GeneralBasm38@gmail.com',
            'password'=>bcrypt('Baf9@fkzh'),
            'phone'=>'676352423',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GENERAL VOYAGES MBOUDA',
            'localisation'=>'Mbouda',
            'email'=>'GeneralMbd23@gmail.com',
            'password'=>bcrypt('jue34Ydhh'),
            'phone'=>'684536277',
            'agency_id'=>1
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GLOBAL BEPANDA',
            'localisation'=>'Douala',
            'email'=>'GlobalDLA54@gmail.com',
            'password'=>bcrypt('1239@fjgdGl'),
            'phone'=>'693678934',
            'agency_id'=>5
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GLOBAL BRAZZAVILLE',
            'localisation'=>'Douala',
            'email'=>'GlobalDLABe23@gmail.com',
            'password'=>bcrypt('bzer3453@fj'),
            'phone'=>'673465534',
            'agency_id'=>5
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GLOBAL MBOPPI',
            'localisation'=>'Douala',
            'email'=>'GlobalMbpi43@gmail.com',
            'password'=>bcrypt('Mbppi34gl@'),
            'phone'=>'654374736',
            'agency_id'=>5
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GLOBAL MVAN',
            'localisation'=>'Yaoundé',
            'email'=>'GlobalMvn20@gmail.com',
            'password'=>bcrypt('239@fj2&4'),
            'phone'=>'673462530',
            'agency_id'=>5
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GLOBAL MFOUNDI',
            'localisation'=>'Yaoundé',
            'email'=>'GlobalMFDI56@gmail.com',
            'password'=>bcrypt('54]@ERH23'),
            'phone'=>'651433092',
            'agency_id'=>5
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GLOBAL DSCHANG',
            'localisation'=>'Dschang',
            'email'=>'GlobalDsg23@gmail.com',
            'password'=>bcrypt('34974@fjhs'),
            'phone'=>'650347634',
            'agency_id'=>5
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'GLOBAL BAFOUSSAM',
            'localisation'=>'Bafoussam',
            'email'=>'GlobalBffm@gmail.com',
            'password'=>bcrypt('Bafglbal@fkjdhh'),
            'phone'=>'680346739',
            'agency_id'=>5
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'UNITED DOUALA',
            'localisation'=>'Douala',
            'email'=>'UnitedDLA23@gmail.com',
            'password'=>bcrypt('United23^rjh@'),
            'phone'=>'674399263',
            'agency_id'=>4
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'UNITED YAOUNDE',
            'localisation'=>'Yaoundé',
            'email'=>'UnitedYDE34@gmail.com',
            'password'=>bcrypt('YDE@feunited'),
            'phone'=>'687365352',
            'agency_id'=>4
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'MEN TRAVEL DOUALA',
            'localisation'=>'Douala',
            'email'=>'MentraDLA23@gmail.com',
            'password'=>bcrypt('frozu@fjhs'),
            'phone'=>'654737292',
            'agency_id'=>8
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'MEN TRAVEL YAOUNDE',
            'localisation'=>'Yaoundé',
            'email'=>'MentraYDE86@gmail.com',
            'password'=>bcrypt('ment673@rj'),
            'phone'=>'693625324',
            'agency_id'=>8
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'TOURISTIQUE YAOUNDE',
            'localisation'=>'Yaoundé',
            'email'=>'TourYDE753@gmail.com',
            'password'=>bcrypt('tour45@fheh'),
            'phone'=>'693439056',
            'agency_id'=>3
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'TOURISTIQUE DOUALA',
            'localisation'=>'Douala',
            'email'=>'DLATouris34@gmail.com',
            'password'=>bcrypt('abziroo@djhg'),
            'phone'=>'653679494',
            'agency_id'=>3
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'BUTSIS DOUALA',
            'localisation'=>'Douala',
            'email'=>'ButsisDl348@gmail.com',
            'password'=>bcrypt('magic34Butf'),
            'phone'=>'651647304',
            'agency_id'=>7
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'BUTSIS FOUMBOT',
            'localisation'=>'Foumbot',
            'email'=>'Foumbot23Butsis@gmail.com',
            'password'=>bcrypt('Fbt78RTE445'),
            'phone'=>'676946350',
            'agency_id'=>7
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'BUTSIS FOUMBAN',
            'localisation'=>'Foumban',
            'email'=>'ButsisFbn25@gmail.com',
            'password'=>bcrypt('fkeggzuIruyr'),
            'phone'=>'654739302',
            'agency_id'=>7
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'INTERCITY DOUALA',
            'localisation'=>'Douala',
            'email'=>'InterDlA23@gmail.com',
            'password'=>bcrypt('Dla45hfhruys'),
            'phone'=>'620746255',
            'agency_id'=>9
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'INTERCITY FOUMBOT',
            'localisation'=>'Foumbot',
            'email'=>'InterFbt26@gmail.com',
            'password'=>bcrypt('miniBusgegru123'),
            'phone'=>'624736476',
            'agency_id'=>9
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'CAMRAIL DOUALA',
            'localisation'=>'Douala',
            'email'=>'Camrail23main@gmail.com',
            'password'=>bcrypt('main123@rkbe'),
            'phone'=>'693467230',
            'agency_id'=>10
         ]);

         DB::table('sub_agencies')->insert([
            'name'=>'CAMRAIL YAOUNDE',
            'localisation'=>'Yaoundé',
            'email'=>'Camrail23Yde@gmail.com',
            'password'=>bcrypt('ydemainegdgrtd'),
            'phone'=>'699654737',
            'agency_id'=>10
         ]);
    }
}
