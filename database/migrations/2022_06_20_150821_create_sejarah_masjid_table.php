<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sejarah_masjid', function (Blueprint $table) {
            $table->id();
            $table->string('foto_masjid');
            $table->string('nama_masjid');
            $table->string('alamat_masjid');
            $table->string('call_center');
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan');
            $table->date('tahun_berdiri');
            $table->string('legalitas');
            $table->text('keterangan_sejarah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sejarah_masjid');
    }
};
