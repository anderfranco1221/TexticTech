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
        Schema::create('orden', function (Blueprint $table) {
            $table->id();
            $table->string("codigo");
            $table->date("fecha_entrega");
            $table->double("total");
            $table->string("tipo");
            $table->string("estado");
            $table->integer("id_usuario");
            $table->timestamps();

            $table->foreignId("id_empresa")->constrained("empresa");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("orden", function (Blueprint $table) {
            $table->dropForeign(['id_empresa']);
        });
        Schema::dropIfExists('orden');
    }
};
