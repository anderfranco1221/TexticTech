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
        Schema::create('producto_material', function (Blueprint $table) {
            $table->id();
            $table->integer("cantidad");
            $table->timestamps();

            $table->foreignId("id_producto")->constrained("producto");
            $table->foreignId("id_material")->constrained("material");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("producto_material", function (Blueprint $table) {
            $table->dropForeign(['id_producto']);
            $table->dropForeign(['id_material']);
        });
        Schema::dropIfExists('producto_material');
    }
};
