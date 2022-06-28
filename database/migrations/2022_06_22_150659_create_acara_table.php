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
        Schema::create('acara', function (Blueprint $table) {
            $table->id();
            $table->string('nama_acara');
            $table->date('tgl_mulai_acara');
            $table->date('tgl_selesai_acara');
            $table->integer('anggaran_dana');
            $table->unsignedBigInteger('ketua_panitia')->nullable();
            $table->unsignedBigInteger('wakil_ketua_panitia')->nullable();
            $table->unsignedBigInteger('sekretaris_acara')->nullable();
            $table->unsignedBigInteger('bendahara_acara')->nullable();
            $table->unsignedBigInteger('koordinator_acara')->nullable();
            $table->unsignedBigInteger('koordinator_konsumsi')->nullable();
            $table->unsignedBigInteger('koordinator_dokumentasi')->nullable();
            $table->unsignedBigInteger('koordinator_keamanan')->nullable();
            $table->unsignedBigInteger('koordinator_peralatan')->nullable();
            $table->unsignedBigInteger('penanggungjawab_acara')->nullable();
            $table->unsignedBigInteger('penasehat_acara')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreign('ketua_panitia')->references('id')->on('jamaah');
            $table->foreign('wakil_ketua_panitia')->references('id')->on('jamaah');
            $table->foreign('sekretaris_acara')->references('id')->on('jamaah');
            $table->foreign('bendahara_acara')->references('id')->on('jamaah');
            $table->foreign('koordinator_acara')->references('id')->on('jamaah');
            $table->foreign('koordinator_konsumsi')->references('id')->on('jamaah');
            $table->foreign('koordinator_dokumentasi')->references('id')->on('jamaah');
            $table->foreign('koordinator_keamanan')->references('id')->on('jamaah');
            $table->foreign('koordinator_peralatan')->references('id')->on('jamaah');
            $table->foreign('penanggungjawab_acara')->references('id')->on('jamaah');
            $table->foreign('penasehat_acara')->references('id')->on('jamaah');
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
        Schema::dropIfExists('acara');
    }
};
