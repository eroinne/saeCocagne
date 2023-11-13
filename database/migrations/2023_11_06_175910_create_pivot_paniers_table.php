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
        Schema::create('pivot_paniers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paniers_id');
            $table->unsignedBigInteger('produits_id');
            $table->foreign('paniers_id')->references('id')->on('paniers')->cascadeOnDelete();
            $table->foreign('produits_id')->references('id')->on('produits')->cascadeOnDelete();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_paniers');
    }
};
