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
        Schema::create('trans_acara', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acara_id');
            $table->date('tgl_trans');
            $table->integer('pemasukan')->nullable();
            $table->integer('pengeluaran')->nullable();
            $table->string('keterangan');
            $table->foreign('acara_id')->references('id')->on('acara');
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
        Schema::dropIfExists('trans_acara');
    }
};
