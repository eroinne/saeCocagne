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

            DB::statement("
                ALTER TABLE adherents CHANGE COLUMN `numeros_telephone` numero_telephone VARCHAR(255) NOT NULL
            ");
            DB::statement("
                ALTER TABLE adherents CHANGE COLUMN `numeros_telephone2` numero_telephone2 VARCHAR(255) NULL
            ");
            DB::statement("
                ALTER TABLE adherents CHANGE COLUMN `numeros_telephone3` numero_telephone3 VARCHAR(255) NULL
            ");

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
