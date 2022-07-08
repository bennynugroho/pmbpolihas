<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKetBerkasToSeleksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seleksi', function (Blueprint $table) {
            $table->string('ket_berkas')->nullable()->after('no_pendaftaran');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seleksi', function (Blueprint $table) {
            $table->dropColumn('ket_berkas');
        });
    }
}
