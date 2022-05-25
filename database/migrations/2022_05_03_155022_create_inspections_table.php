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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lift_id');
            $table->date('inspection_date');
            $table->text('inspection_protocol');
            $table->text('inspection_label');
            $table->text('inspection_result');
            $table->text('inspection_participant_1_profession')->nullable();
            $table->text('inspection_participant_1_name')->nullable();
            $table->text('inspection_participant_2_profession')->nullable();
            $table->text('inspection_participant_2_name')->nullable();
            $table->enum('inspection_type', [
                'Pirmreizējā', 'Kārtējā', 'Ārpuskārtas', 'Atkārtotā'
            ]);
            $table->text('incpection_notes');
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
        Schema::dropIfExists('inspections');
    }
};
