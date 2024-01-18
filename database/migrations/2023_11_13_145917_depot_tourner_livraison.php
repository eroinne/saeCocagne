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
            $table->unsignedBigInteger('depot_id');
            $table->foreign('depot_id')->references('id')->on('depot')->cascadeOnDelete();
            $table->unsignedBigInteger('tournee_id');
            $table->foreign('tournee_id')->references('id')->on('tournees_de_livraison')->cascadeOnDelete();
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
