<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lift_manager_id');
            $table->string('reg_number', 128)->unique();
            $table->string('lift_type', 128);
            $table->string('manufacturer_name', 128);
            $table->integer('manufacture_year');
            $table->string('city', 128);
            $table->string('street');
            $table->string('house');
            $table->string('entrance');
//            $table->string('factory_number', 128);
//            $table->string('installer', 128);
//            $table->string('country', 128);
//            $table->enum('city_region', [
//                'Centra rajons', 'Latgales priekšpilsēta', 'Vidzemes priekšpilsēta', 'Ziemeļu priekšpilsēta',
//                'Zemgales priekšpilsēta', 'Kurzemes rajons'
//            ]);
//            $table->integer('floors_total');
//            $table->integer('floors_serviced');
//            $table->integer('load_capacity');
//            $table->float('speed', 4, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lifts');
    }
};
