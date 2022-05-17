<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lift>
 */
class LiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lift_manager_id' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'reg_number' => $this->faker->unique()->numerify('4CL######'),
            'lift_type' => 'electric',
            'manufacturer_name' => $this->faker->randomElement(['KONE', 'Shindler', 'Mogilev', 'Orona', 'OTIS']),
            'manufacture_year' => $this->faker->year('-10years'),
        ];
    }
}
