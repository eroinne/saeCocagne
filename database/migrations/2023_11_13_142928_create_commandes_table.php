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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structures_id');
            $table->foreign('structures_id')->references('id')->on('structures')->cascadeOnDelete();
            $table->unsignedBigInteger('adherents_id');
                $table->foreign('adherents_id')->references('id')->on('adherents')->cascadeOnDelete();
            $table->unsignedBigInteger('tournee_id');
            $table->foreign('tournee_id')->references('id')->on('tournees_de_livraison')->cascadeOnDelete();
            $table->unsignedBigInteger('abonnements_id')->nullable();
            $table->foreign('abonnements_id')->references('id')->on('abonnements')->cascadeOnDelete();
            $table->unsignedBigInteger('produits_id')->nullable();
            $table->foreign('produits_id')->references('id')->on('produits')->cascadeOnDelete();
            $table->date('date_commande');
            $table->date('date_preparation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
