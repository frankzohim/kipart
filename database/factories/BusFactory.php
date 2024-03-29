<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'registration'=>$this->faker->ean13(),
            'number_of_places'=>rand(30,100),
            'agency_id'=>rand(1,10),
            'plan'=>$this->faker->uuid()
        ];
    }
}
