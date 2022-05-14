<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            LiftSeeder::class,
            AdminSeeder::class,
            LiftManagerSeeder::class
        ]);

        //LU
//        DB::table('lifts')->insert([
//            'title' => Str::random(10),
//            'body' => Str::random(10),
//        ]);
    }
}

