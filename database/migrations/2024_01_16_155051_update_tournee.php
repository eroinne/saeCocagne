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
            $table->dropColumn('jour_preparation');
            $table->dropColumn('jour_livraison');

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
