<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('nama')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nik')->nullable();
            $table->string('kk')->nullable();
            $table->string('kel')->nullable();
            $table->string('kec')->nullable();
            $table->string('kp')->nullable();
            $table->string('tlp')->nullable();
            $table->string('wa')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->string('slta')->nullable();
            $table->string('thn_slta')->nullable();
            $table->string('nisn')->nullable();
            $table->string('npsn')->nullable();
            $table->string('jur_slta')->nullable();
            $table->string('prestasi_akd')->nullable();
            $table->string('prestasi_non_akd')->nullable();
            $table->string('ayah')->nullable();
            $table->string('kerja_ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->string('kerja_ibu')->nullable();
            $table->integer('jum_anak')->nullable();
            $table->string('penghasilan_ortu')->nullable();
            $table->string('alamat_ortu')->nullable();
            $table->string('tlp_ortu')->nullable();
            $table->unsignedInteger('jalur_id');
            $table->unsignedInteger('kelas1_id');
            $table->unsignedInteger('kelas2_id');
            $table->string('sumber_info')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('tgl_daftar');
            $table->unsignedInteger('thn_akd_id');
            $table->string('nama_rekomendasi')->nullable();
            $table->string('tlp_rekomendasi')->nullable();
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
        Schema::dropIfExists('pendaftar');
    }
}
