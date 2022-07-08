<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jalur_masuk extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jalur_masuk')->insert([
            [
                'judul'        => 'Reguler',
                'keterangan'   => 'Jalur masuk umum',
                'foto'         => 'foto.jpg',
                'tgl_akhir'    => today(),
            ],
            [
                'judul'        => 'Beasiswa Unggulan',
                'keterangan'   => 'Beasiswa Unggulan (BU) Politeknik Hasnur adalah beasiswa yang diberikan langsung oleh Yayasan Hasnur Centre (YHC). Beasiswa ini diberikan kepada pendaftar yang memiliki prestasi selama bersekolah di SLTA (SMK/SMA/MA). Pemberian beasiswa ini berupa bebas biaya SPP selama masa kuliah 3 tahun.',
                'foto'         => 'foto.jpg',
                'tgl_akhir'    => today(),
            ],
            [
                'judul'        => 'Berdikari',
                'keterangan'   => 'Beasiswa Berdikari Politeknik Hasnur merupakan program untuk membantu mahasiswa dalam meringankan biaya pendidikan. Program ini mengijinkan mahasiswa untuk membayar biaya pendidikan setelah lulus kuliah dan mendapat pekerjaan. Sehingga, mahasiswa dapat lebih fokus dalam mengikuti perkuliahan tanpa perlu khawatir dalam masalah pembiayaan.',
                'foto'         => 'foto.jpg',
                'tgl_akhir'    => today(),
            ],
            [
                'judul'        => 'KIP-Kuliah',
                'keterangan'   => 'Beasiswa ini merupakan pemberian dari DIKTI kepada mahasiswa Politeknik Hasnur. Jangka waktu pembiayaan berlaku hingga 1 tahun (2 semester). Beasiswa ini diberikan kepada mahasiswa yang tidak mampu namun berprestasi dan memiliki Indeks Prestasi Kumulatif (IPK) tertinggi.',
                'foto'         => 'foto.jpg',
                'tgl_akhir'    => today(),
            ],
        ]);
    }
}
