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
        //pass if exists
        Schema::create('tournees_de_livraison', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structures_id');
            $table->foreign('structures_id')->references('id')->on('structures')->cascadeOnDelete();
            $table->date('jour_preparation');
            $table->date('jour_livraison');
            $table->string('couleur', 255);
            //we manage the repository list in a string by separating the repositories from one ;
            $table->string('point_depots', 500);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourner_livraisons');
    }
};
