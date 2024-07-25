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
        Schema::create('tb_pengajuan_kuker', function (Blueprint $table) {
            $table->string('id_pengajuan', 10)->primary();
            $table->string('nama_perwakilan');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('no_hp_alternatif');
            $table->text('nama_instansi');
            $table->longText('alamat_instansi');
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->longText('topik_diskusi');
            $table->integer('jumlah_peserta')->required();
            $table->longText('nama_peserta')->nullable();
            $table->string('cv')->required();
            $table->string('surat_pengajuan')->nullable();
            $table->unsignedBigInteger('kabupaten_id');
            $table->unsignedBigInteger('lokasi_id');

            $table->foreign('kabupaten_id')->references('id')->on('tb_kabupaten');
            $table->foreign('lokasi_id')->references('id')->on('tb_lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengajuan_kuker');
    }
};
