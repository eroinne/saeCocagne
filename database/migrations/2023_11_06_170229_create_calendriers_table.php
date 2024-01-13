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
        Schema::dropIfExists('calendriers');
        Schema::create('calendriers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structures_id');
            $table->foreign('structures_id')->references('id')->on('structures')->cascadeOnDelete();
            //string where day are separated by ;
            $table->string('jours_livraison', 255);
            //num of weeks that aren't possible for delivery
            $table->integer('semaines_non_livrable');
            //foreing key to tournees_de_livraison
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
        Schema::dropIfExists('calendriers');
    }
};
