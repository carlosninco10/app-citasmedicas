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
        Schema::create('medicos_especialistas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->unsignedBigInteger('especialidad_id')->nullable();


            $table->foreign('medico_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialistas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos_especialistas');
    }
};
