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
        Schema::table('tournees_de_livraison', function (Blueprint $table) {
            $table->string('jour_preparation')->after('structures_id');
            $table->string('jour_livraison')->after('jour_preparation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournees_de_livraison', function (Blueprint $table) {
            //
        });
    }
};
