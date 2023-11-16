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
        Schema::create('abonnement_panier', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('abonnements_id');
            $table->foreign('abonnements_id')->references('id')->on('abonnements')->cascadeOnDelete();
            $table->unsignedBigInteger('paniers_id');
            $table->foreign('paniers_id')->references('id')->on('paniers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
