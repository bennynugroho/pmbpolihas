<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class syarat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persyaratan')->insert([
            [
                'syarat' => 'Fotocopy Ijazah & SKHU berlegalisir (KTP)'
            ],
            [
                'syarat' => 'Fotocopy Raport dari semester 1 sampai akhir'
            ],
            [
                'syarat' => 'Fotocopy KTP/ Kartu Pelajar'
            ],
            [
                'syarat' => 'Fotokopi Kartu Keluarga'
            ],
            [
                'syarat' => 'Fotocopy Akte Kelahiran'
            ],
            [
                'syarat' => 'Fotocopy KTP Orang Tua/Wali'
            ],
            [
                'syarat' => 'Pasfoto berwarna 4x6 & 3x4 sebanyak 4 lembar'
            ],
            [
                'syarat' => 'Surat Keterangan Berbadan Sehat'
            ],
            [
                'syarat' => 'Surat Keterangan Tidak Buta Warna (BTP & TO)'
            ],
            [
                'syarat' => 'Surat Rekomendasi dari Sekolah Asal (Beasiswa)'
            ],
            [
                'syarat' => 'Surat Keterangan Tidak Mampu (Beasiswa)'
            ],
            [
                'syarat' => 'Fotocopy Kartu Indonesia Pintar (Beasiswa)'
            ],
            [
                'syarat' => 'Fotocopy Sertifikat/ Piagam Penghargaan (Beasiswa)'
            ],
        ]);
    }
}
