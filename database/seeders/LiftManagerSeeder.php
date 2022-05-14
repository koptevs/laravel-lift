<?php

namespace Database\Seeders;

use App\Models\LiftManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LiftManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiftManager::factory()->times(5)->create();
    }
}
