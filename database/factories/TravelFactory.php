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
        'date'=>$this->faker->dateTimeThisYear('+10 months'),
        'path_id'=>rand(1,19),
        'agency_id'=>rand(1,6),
        'price'=>$this->faker->randomElement($array=[2000,4000,2500,5000,3500]),
        'state'=>1,
        'type'=>$this->faker->randomElement($array=['Aller Simple','Aller Retour']),
        'class'=>$this->faker->randomElement($array=['vip','classique']),
        ];
    }
}
