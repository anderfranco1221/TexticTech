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

            $table->foreignId("producto_id")->constrained("producto");
            $table->foreignId("material_id")->constrained("material");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("producto_material", function (Blueprint $table) {
            $table->dropForeign(['producto_id']);
            $table->dropForeign(['material_id']);
        });
        Schema::dropIfExists('producto_material');
    }
};
