<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'patient_id' );
            $table->date( 'appointment_date' );
            $table->tinyInteger( 'bp_reading' );
            $table->decimal( 'temperature' );
            $table->decimal( 'sugar_levels' );

            $table->foreign( 'patient_id' )->references( 'id' )->on( 'patients' );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
