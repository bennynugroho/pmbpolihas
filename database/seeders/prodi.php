<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class prodi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prodi')->insert([
            [
                'nama'       => 'Teknik Otomotif',
                'slug'       => 'teknik-otomotif',
                'visi'       => '• Menjadi program studi terdepan dalam pendidikan keahlian dan keterampilan di bidang otomotif.',
                'misi'       => '• Menyelenggarakan pendidikan keahlian dan keterampilan di bidang otomotif untuk menghasilkan lulusan yang unggul, berjiwa wirausaha, terampil, inovatif, bermoral dan berakhlak mulia.\r\n• Melakukan penelitian unggulan berbasis teknologi terapan yang inovatif di bidang otomotif.\r\n• Mengembangkan kerjasama keitraan dan menerapkan ilmu pengetahuan dan teknologi melalui kegiatan pengabdian kepada masyarakat dalam bidang otomotif.\r\n• Melaksanakan tata kelola yang baik pada Program Studi Diploma III Teknik Otomotif berbasis Good University Governance.',
                'foto'       => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Teknik Informatika',
                'slug'       => 'teknik-informatika',
                'visi'       => '• Menjadi program studi unggulan yang mampu mencetak tenaga yang terampil dan profesional dalam bidang teknologi informatika.',
                'misi'       => '• Menyelenggarakan program Pendidikan dan Pengajaran yang diakui baik ditingkat regional maupun tingkat nasional di bidang teknik informatika yang handal dan mampu mengikuti perkembangan teknologi informasi dan komunikasi.',
                'foto'       => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Budidaya Tanaman Perkebunan',
                'slug'       => 'budidaya-tanaman-perkebunan',
                'visi'       => '• Menjadi program studi unggula di bidang budidaya tanaman perkebunan dalam penerapan teknologi budidaya tanaman perkebunan.',
                'misi'       => '• Dengan sistem manajemen yang baik untuk menghasilkan lulusan yang terampil dan profesional serta mampu menerapkan ilmu pengetahuan di bidang budidaya tanaman perkebunan.',
                'foto'       => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Bisnis Digital',
                'slug'       => 'bisnis-digital',
                'visi'       => '• memajukan ilmu pengetahuan, penelitian, dan pengabdian masyarakat dalam menghadapi tantangan global.',
                'misi'       => '• Menyelenggarakan penelitian dalam rangka pengembangan ilmu pengetahuan dan teknologi dalam pemanfaatan potensi daerah dibidang Bisnis Digital.',
                'foto'       => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
