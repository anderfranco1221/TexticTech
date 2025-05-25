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
        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_material")->constrained("material");
            $table->foreignId("id_empresa")->constrained("empresa");
            $table->double("valor");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("precios", function (Blueprint $table) {
            $table->dropForeign(['id_empresa']);
            $table->dropForeign(['id_material']);
        });
        Schema::dropIfExists('precios');
    }
};
