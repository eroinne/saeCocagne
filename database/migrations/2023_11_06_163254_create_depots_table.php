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
        Schema::create('depot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_structure');
            $table->foreign('id_structure')->references('id')->on('structures');
            $table->string('nom', 255);
            $table->string('ville', 255);
            $table->string('adresse', 255);
            $table->string('code_postal', 255);
            $table->string('telephone', 255);
            $table->string('mail', 255)->nullable();
            $table->string('siteWeb', 255)->nullable();
            $table->string('mail_referent', 255);
            $table->string('telephone_referent', 255);
            $table->date('jour_livraison');
            $table->time('heure_livraison');
            $table->time('heure_paniers');
            $table->string('text_presentation', 255)->nullable();
            $table->string('chemin_image', 255)->nullable();
            $table->string('commentaire', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depots');
    }
};
