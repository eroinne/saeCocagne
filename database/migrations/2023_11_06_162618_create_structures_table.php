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
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('ville', 255);
            $table->string('raison_sociale', 255);
            $table->string('siege_social', 255);
            $table->string('adresse_gestion', 255);
            $table->string('telephone', 255);
            $table->string('mail', 255);
            $table->string('nom_referent', 255)->nullable()->cascadeOnDelete();
            $table->string('site_web', 255);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
