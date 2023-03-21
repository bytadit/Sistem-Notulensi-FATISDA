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
        Schema::table('notulensi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rapat');
            $table->foreign('id_rapat')->references('id')->on('rapat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notulensi', function (Blueprint $table) {
            $table->dropForeign(['id_rapat']);
            $table->dropColumn('id_rapat');
        });
    }
};
