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
            $table->unsignedBigInteger('disponibilidad_id')->nullable();
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'realizada'])->default('pendiente');
            $table->text('observaciones');
            $table->timestamps();

            $table->foreign('paciente_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidades')->onDelete('cascade');
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
