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
        Schema::create('verificacions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_completo')->nullable(false);
            $table->string('dni',8)->nullable(false);
            $table->string('suministro')->nullable(false);
            $table->string('celular',9)->nullable(false);
            $table->string('direccion')->nullable(false);
            $table->string('ruta')->nullable(false);
            $table->string('latitud')->nullable(false);
            $table->string('longitud')->nullable(false);
            $table->date('fecha_fin')->nullable(false);
            $table->string('tipo')->nullable(false);
            $table->string('estado')->nullable(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verificacions');
    }
};
