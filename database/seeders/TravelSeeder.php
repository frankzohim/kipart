<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Travel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $travels=Travel::all();
        $travels->each(function ($u) {
            $u->bus()->save(Bus::factory()->make());
        });
    }
}
