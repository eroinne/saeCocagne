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
        Schema::create('adherents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('raison_sociale', 255);
            $table->string('civilite', 255);
            $table->string('email')->unique();
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->string('ville', 255);
            $table->string('adresse', 255);
            $table->string('code_postal', 255);
            $table->string('numeros_telephone', 255);
            $table->string('numeros_telephone2', 255)->nullable();
            $table->string('numeros_telephone3', 255)->nullable();
            $table->string('profession', 255)->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('date_premiere_adhesion', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('structures_id');
            $table->foreign('structures_id')->references('id')->on('structures')->cascadeOnDelete();
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adherents');
    }
};
