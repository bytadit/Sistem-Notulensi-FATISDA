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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->string('jabatan_peserta')->nullable();
            $table->tinyInteger('status_konfirmasi')->default(0)->comment('0:tidak hadir; 1:hadir; 2:izin; 3:sakit');
            $table->string('detail_konfirmasi')->nullable();
            $table->tinyInteger('status_kehadiran')->default(0)->comment('0:tidak hadir; 1:hadir; 2:izin; 3:sakit');
            $table->string('detail_kehadiran')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_pegawai')->references('id')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
