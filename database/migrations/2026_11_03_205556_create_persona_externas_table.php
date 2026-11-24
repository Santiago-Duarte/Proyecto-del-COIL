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
        Schema::create('persona_externas', function (Blueprint $table): void {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('celular', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_externas');
    }
};
