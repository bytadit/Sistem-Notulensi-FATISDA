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
        Schema::table('rapat', function (Blueprint $table) {
            $table->foreign('id_penanggung_jawab')->references('id')->on('jabatan_pegawai')->onDelete('set null');
            $table->foreign('id_notulis')->references('id')->on('jabatan_pegawai')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rapat', function (Blueprint $table) {
            //
        });
    }
};
