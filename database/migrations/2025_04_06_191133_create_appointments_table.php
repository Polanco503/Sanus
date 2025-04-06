<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->dateTime('fecha_cita');
            $table->string('estado')->default('pendiente'); // pendiente, realizada, cancelada
            $table->timestamps();

            // Claves foráneas
            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('doctor_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};