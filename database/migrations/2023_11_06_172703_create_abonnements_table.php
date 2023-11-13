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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_structure');
            $table->foreign('id_structure')->references('id')->on('structures')->cascadeOnDelete();
            //number of days of the subscription
            $table->integer('duree');
            $table->string('periodicite', 255);
            $table->string('type_abonnement', 255);
            $table->string('moyen_paiement', 255);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};
