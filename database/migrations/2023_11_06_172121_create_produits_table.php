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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('type', 255);
            $table->string('unite', 255)->nullable();
            $table->string('valeur_unite', 255)->nullable();
            $table->unsignedBigInteger('structures_id');
            $table->foreign('structures_id')->references('id')->on('structures')->cascadeOnDelete();
            $table->integer('prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
