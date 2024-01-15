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
        Schema::table('depot', function (Blueprint $table) {
            $table->dropColumn('jour_livraison');
            $table->string('jour_livraison')->after('telephone_referent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('depot', function (Blueprint $table) {
            //
        });
    }
};
