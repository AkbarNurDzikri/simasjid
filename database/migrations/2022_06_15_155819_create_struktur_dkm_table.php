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
        Schema::create('struktur_dkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengurus_id');
            $table->string('jabatan');
            $table->string('tupoksi');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->foreign('pengurus_id')->references('id')->on('jamaah');
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
        Schema::dropIfExists('struktur_dkm');
    }
};
