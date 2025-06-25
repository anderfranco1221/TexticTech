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
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string("tipo_documento");
            $table->string("documento");
            $table->string("nombre");
            $table->string("correo")->nullable();
            $table->string("telefono")->nullable();
            $table->string("direccion")->nullable();
            $table->boolean("estado");
            $table->boolean("proveedor");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa');
    }
};
