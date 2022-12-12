<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date'=>$this->faker->date($format = 'Y-m-d', $max = 'now') ,
        'path_id'=>rand(1,19),
        'agency_id'=>rand(1,6),
        'price'=>$this->faker->numberBetween($min = 1000, $max = 9000),
        'state'=>1,
        'type'=>$this->faker->randomElement($array=['Aller Simple','Aller Retour']),
        'class'=>$this->faker->randomElement($array=['vip','classique']),
        ];
    }
}
