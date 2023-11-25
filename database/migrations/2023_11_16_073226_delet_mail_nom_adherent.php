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
        Schema::table('adherents', function (Blueprint $table) {
            $table->dropColumn('nom');
            $table->dropColumn('adresse_mail');
            //modifier le nom de la colonne
            $table->renameColumn('numeros_telephone', 'numero_telephone');
            $table->renameColumn('numeros_telephone2', 'numero_telephone2');
            $table->renameColumn('numeros_telephone3', 'numero_telephone3');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
