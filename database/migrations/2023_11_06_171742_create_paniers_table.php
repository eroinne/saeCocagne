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
        Schema::dropIfExists('paniers');
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('structures_id');
            $table->foreign('structures_id')->references('id')->on('structures')->cascadeOnDelete();
            $table->string('type',255);
            $table->string('nom',255);
            $table->unsignedBigInteger('id_abonnements');
            $table->foreign('id_abonnements')->references('id')->on('abonnements')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paniers');
    }
};
