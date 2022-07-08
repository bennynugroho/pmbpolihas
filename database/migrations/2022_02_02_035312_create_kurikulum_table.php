<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKurikulumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('semester');
            $table->string('kode');
            $table->string('mata_kuliah');
            $table->tinyInteger('sks_teori');
            $table->tinyInteger('sks_praktek');
            $table->tinyInteger('jam');
            $table->unsignedInteger('prodi_id');
            $table->timestamps();

            $table->foreign('prodi_id')->references('id')->on('prodi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kurikulum');
    }
}
