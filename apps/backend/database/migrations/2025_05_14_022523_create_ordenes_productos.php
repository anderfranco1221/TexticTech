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
        Schema::create('orden_detalles', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->integer("cantidad");
            $table->double("valor_unitario");
            $table->double("valor_total");
            $table->foreignId("id_orden")->constrained("orden");
            $table->foreignId("id_material")->nullable()->constrained("material");
            $table->foreignId("id_producto")->nullable()->constrained("producto");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("orden_detalles", function (Blueprint $table) {
            $table->dropForeign(['id_orden']);
            $table->dropForeign(['id_material']);
            $table->dropForeign(['id_producto']);
        });
        Schema::dropIfExists('orden_detalles');
    }
};
