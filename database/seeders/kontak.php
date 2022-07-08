<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kontak extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('akun_kontak')->insert([
            [
                'facebook'  => 'https://web.facebook.com/polihasnur/',
                'twitter'   => 'https://twitter.com/Polihasnur_',
                'instagram' => 'https://www.instagram.com/polihasnur/',
                'youtube'   => 'https://www.youtube.com/channel/UCwSY3I2GH_QEuu2aX',
                'email'     => 'polihasnur@polihasnur.ac.id',
                'telepon'   => '0851 0015 6666',
            ]
        ]);
    }
}
