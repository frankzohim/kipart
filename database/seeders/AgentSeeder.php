<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agents')->insert([
            'id'=>1,
            'name'=>'Mbarga Paul',
            'sub_agency_id'=>1,
            'email'=>'MbargaPaul23@gmail.com',
            'password'=>bcrypt('buca238@ghj'),
            'role_id'=>2,
         ]);
         DB::table('agents')->insert([
            'id'=>2,
            'name'=>'Viviane Ndoumbe',
            'sub_agency_id'=>2,
            'email'=>'NdoumbeViviane@gmail.com',
            'password'=>bcrypt('YdeBuca34'),
            'role_id'=>2,
         ]);
    }
}
