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
        Schema::create('jamaah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jamaah');
            $table->string('no_ktp');
            $table->string('no_kk');
            $table->string('alamat_jamaah');
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenkel',['L','P']);
            $table->enum('status_nikah', [3,2,1,0]);
            $table->enum('agama', ['Islam', 'Katolik', 'Protestan', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('gol_darah', ['A', 'B', 'AB', 'O', '-'])->nullable();
            $table->string('pekerjaan');
            $table->enum('status_ekonomi', [2,1,0]);
            $table->enum('status_jamaah', ['Anggota DKM', 'Jamaah', 'Non Jamaah']);
            $table->string('foto_jamaah');
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
        Schema::dropIfExists('jamaah');
    }
};
