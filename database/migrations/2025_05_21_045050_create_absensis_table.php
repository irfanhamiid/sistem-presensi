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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_karyawan');
            $table->text('gambar');
            $table->text('lokasi');
            $table->timestamp('waktu');
            $table->enum('tipe',['masuk','keluar']);
            $table->text('keterangan')->nullable();
            $table->enum('status',['Tepat Waktu','Terlambat','Lebih Awal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
