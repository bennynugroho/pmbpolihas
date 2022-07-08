<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeleksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seleksi', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('daftar_id');
            $table->unsignedInteger('thn_akd_id');
            $table->string('no_pendaftaran');
            $table->timestamps();

            $table->foreign('daftar_id')->references('id')->on('pendaftar');
            $table->foreign('thn_akd_id')->references('id')->on('tahun_akademik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seleksi');
    }
}
