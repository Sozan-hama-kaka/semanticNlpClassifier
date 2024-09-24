<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubfieldTblTerms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('tbl_terms', function (Blueprint $table) {
            $table->string('subfield')->nullable(); // Add subfield column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('tbl_terms', function (Blueprint $table) {
            $table->dropColumn('subfield'); // Remove the subfield column
        });
    }
}

