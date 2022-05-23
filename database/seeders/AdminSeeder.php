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
            'name'     => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$KF6rRw9iE/9lM9TPQHCWUONfnVOk0brj2258ET76Cfr9d.Jmo8Ue2'
        ]);
    }
}
