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
        Schema::table('calendriers', function (Blueprint $table) {
            $table->dropColumn('jours_livraison');
            $table->integer('annee')->after('structures_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendriers', function (Blueprint $table) {
            //
        });
    }
};
