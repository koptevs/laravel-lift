<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->times(1)->create([
            'is_admin' => true,
            'name'     => 'Igor',
            'email' => 'igor@example.com',
            'password' => '$2y$10$2Lvpe3N/LB4f94qsgqxuWeYG2qLEAu1SJKrbuu3kz0F2TBp4DgXOW'
        ]);
    }
}
