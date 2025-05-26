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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado',['pendiente', 'confirmada', 'cancelada', 'realizada'])->default('pendiente');
            $table->text('observaciones');
            $table->timestamp('fecha_creacion')->useCurrent();

            $table->foreign('paciente_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('medico_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
