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
        Schema::create('trans_inventaris', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_trans');
            $table->unsignedBigInteger('inventaris_id');
            $table->integer('barang_masuk')->nullable();
            $table->integer('barang_keluar')->nullable();
            $table->string('keterangan');
            $table->foreign('inventaris_id')->references('id')->on('inventaris');
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
        Schema::dropIfExists('trans_inventaris');
    }
};
