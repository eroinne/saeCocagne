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
            $table->unsignedBigInteger('id_adherent');
            $table->foreign('id_adherent')->references('id')->on('adherents')->cascadeOnDelete();
            $table->unsignedBigInteger('id_tournee');
            $table->foreign('id_tournee')->references('id')->on('tournees_de_livraison')->cascadeOnDelete();
            $table->unsignedBigInteger('id_abonnement');
            $table->foreign('id_abonnement')->references('id')->on('abonnements')->cascadeOnDelete();
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
