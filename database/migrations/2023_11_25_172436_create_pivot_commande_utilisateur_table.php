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
        Schema::create('pivot_commande_utilisateur', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('paniers_utilisateurs_id');
            $table->foreign('paniers_utilisateurs_id')->references('id')->on('paniers_utilisateurs')->cascadeOnDelete();
            $table->unsignedBigInteger('paniers_id');
            $table->foreign('paniers_id')->references('id')->on('paniers')->cascadeOnDelete();
            $table->unsignedBigInteger('produits_id');
            $table->foreign('produits_id')->references('id')->on('produits')->cascadeOnDelete();
            $table->integer('quantite');
            $table->integer('prix');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_commande_utilisateur');
    }
};
