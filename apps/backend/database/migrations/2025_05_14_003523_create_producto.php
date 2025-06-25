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
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string("codigo");
            $table->string("nombre");
            $table->text("descripcion")->nullable();
            $table->double("precio");
            $table->integer("stock");
            $table->boolean("estado");
            $table->integer("id_usuario");
            $table->timestamps();

            $table->foreignId("id_categoria")->constrained("categoria");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("producto", function (Blueprint $table) {
            $table->dropForeign(['id_categoria']);
        });
        Schema::dropIfExists('producto');
    }
};
