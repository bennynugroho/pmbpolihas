<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balasan', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('subjek');
            $table->text('isi');
            $table->unsignedInteger('pesan_id');
            $table->timestamps();

            $table->foreign('pesan_id')->references('id')->on('pesan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balasan');
    }
}
