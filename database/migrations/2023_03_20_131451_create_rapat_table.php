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
        Schema::create('rapat', function (Blueprint $table) {
            $table->id();
            $table->string('judul_rapat')->nullable();
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->tinyInteger('bentuk_rapat')->nullable()->comment('online or offline');
            $table->string('lokasi_rapat')->nullable()->comment('bisa berisi link jika online');
            $table->tinyInteger('status')->nullable()->comment('0: Belum Terlaksana, 1: Telah Terlaksana, 2: Ditunda, 3: Batal');
            $table->unsignedBigInteger('id_kategori_rapat')->nullable();
            $table->unsignedBigInteger('id_penanggung_jawab')->nullable()->onDelete;
            $table->unsignedBigInteger('id_notulis')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_kategori_rapat')->references('id')->on('kategori_rapat')->onDelete('set null');
            $table->foreign('id_penanggung_jawab')->references('id')->on('pegawai')->onDelete('set null');
            $table->foreign('id_notulis')->references('id')->on('pegawai')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapat');
    }
};
