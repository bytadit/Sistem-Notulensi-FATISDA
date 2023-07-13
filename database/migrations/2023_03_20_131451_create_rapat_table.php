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
            $table->string('slug')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_draft')->default(0);
            $table->tinyInteger('prioritas')->comment('1:rendah; 2:sedang: 3:tinggi');
            $table->string('bentuk_rapat')->nullable()->comment('online or offline');
            $table->string('lokasi_rapat')->nullable()->comment('bisa berisi link jika online');
            $table->tinyInteger('status')->nullable()->comment('0: Dijadwalkan, 1: Berlangsung, 2: Selesai');
            $table->unsignedBigInteger('id_kategori_rapat')->nullable();
            $table->unsignedBigInteger('id_penanggung_jawab')->nullable()->onDelete;
            $table->unsignedBigInteger('id_notulis')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->foreign('id_kategori_rapat')->references('id')->on('kategori_rapat')->onDelete('set null');

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
