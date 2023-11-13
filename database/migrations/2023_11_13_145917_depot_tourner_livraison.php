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
        Schema::create('depot_tournee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_depot');
            $table->foreign('id_depot')->references('id')->on('depot')->cascadeOnDelete();
            $table->unsignedBigInteger('id_tournee');
            $table->foreign('id_tournee')->references('id')->on('tournees_de_livraison')->cascadeOnDelete();
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
