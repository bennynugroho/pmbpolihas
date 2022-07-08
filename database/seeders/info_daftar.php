<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class info_daftar extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('info_daftar')->insert([
            [
                'tgl_awal_daftar'     => today(),
                'tgl_akhir_daftar'    => today(),
                'terakhir_pembayaran' => today(),
                'bank'                => 'BNI',
                'rekening'            => '666-666-4676',
            ]
        ]);
    }
}
