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
        // Renombrar la tabla a plural
        Schema::rename('producto', 'productos');

        // Hacer el campo imagen nullable
        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Volver a singular y quitar nullable
        Schema::rename('productos', 'producto');

        Schema::table('producto', function (Blueprint $table) {
            $table->string('imagen')->nullable(false)->change();
        });
    }
};
