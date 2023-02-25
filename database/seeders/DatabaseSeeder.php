<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\BusSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\PathSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\AgentSeeder;
use Database\Seeders\AgencySeeder;
use Database\Seeders\TravelSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ScheduleSeeder;
use Database\Seeders\SubAgencySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PathSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(AgencySeeder::class);
        $this->call(BusSeeder::class);
        $this->call(ScheduleSeeder::class);
        // $this->call(TravelSeeder::class);
        $this->call(SubAgencySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AgentSeeder::class);



    }
}
