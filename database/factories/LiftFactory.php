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
            'factory_number' => $this->faker->numerify('NR####'),
            'lift_type' => $this->faker->randomElement(['elektriskais', 'hidrauliskais']),
            'manufacturer_name' => $this->faker->randomElement(['KONE', 'Shindler', 'Mogilev', 'Orona', 'OTIS']),
            'manufacture_year' => $this->faker->year('-10years'),
            'city' => $this->faker->randomElement(['Rīga', 'Ventspils', 'Rezekne', 'Jūrmala']),
            'country' => $this->faker->randomElement(['Latvija', 'Lietuva', 'Igaunija']),
            'street' => $this->faker->streetName,
            'house' => $this->faker->numberBetween(1, 100),
            'postal_code' => $this->faker->numerify('LV-####'),
            'entrance' => $this->faker->randomElement(['I', 'II', 'III', 'IV']),
            'installer' => $this->faker->randomElement(['AS Shindler Electric', 'SIA Labi Lifti', 'SIA Sharazh Montazh', 'NULL']),
            'load_capacity' => $this->faker->randomElement(['320', '400', '500', '1000']),
            'speed' => $this->faker->randomElement(['0.71', '1']),
            'city_region' => $this->faker->randomElement([
                'Centra rajons', 'Latgales priekšpilsēta', 'Vidzemes priekšpilsēta', 'Ziemeļu priekšpilsēta',
                'Zemgales priekšpilsēta', 'Kurzemes rajons'
            ]),
            'floors_total' => $this->faker->randomElement(['5', '7', '9', '12']),
            'floors_serviced' => $this->faker->randomElement(['5', '7', '9', '12']),
        ];
    }
}
