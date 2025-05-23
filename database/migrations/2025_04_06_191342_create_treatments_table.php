<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('nombre_medicamento');
            $table->string('dosis');
            $table->string('frecuencia'); // Ej: "Cada 8 horas"
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
