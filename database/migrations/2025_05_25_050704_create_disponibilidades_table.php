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
        Schema::create('disponibilidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medico_especialidad_id')->nullable;
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();

            $table->foreign('medico_especialidad_id')->references('id')->on('medicos_especialistas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disponibilidades');
    }
};
