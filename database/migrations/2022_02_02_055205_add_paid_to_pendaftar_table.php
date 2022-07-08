<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToPendaftarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->foreign('jalur_id')->references('id')->on('jalur_masuk')->onDelete('cascade');
            $table->foreign('kelas1_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('kelas2_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('thn_akd_id')->references('id')->on('tahun_akademik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropForeign(['jalur_id']);
            $table->dropForeign(['kelas1_id']);
            $table->dropForeign(['kelas2_id']);
            $table->dropForeign(['thn_akd_id']);
        });
    }
}
