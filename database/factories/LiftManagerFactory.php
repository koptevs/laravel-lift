<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LiftManager>
 */
class LiftManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Rīgas Super Pārvaldnieks',
                'Saulespuķu Mājas',
                'DzIKS Gudgrība',
                'SIA Naudu Pumpis',
                'AS Ērti Nami',
            ]),
            'address' => $this->faker->address(),
            'reg_number' => $this->faker->unique()->numerify('###########')
        ];
    }
}
