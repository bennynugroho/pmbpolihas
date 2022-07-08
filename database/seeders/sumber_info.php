<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sumber_info extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sumber_info')->insert([
            [
                'info' => 'Brosur',
            ],
            [
                'info' => 'Spanduk',
            ],
            [
                'info' => 'Baliho',
            ],
            [
                'info' => 'Radio',
            ],
            [
                'info' => 'Teman',
            ],
            [
                'info' => 'Saudara',
            ],
            [
                'info' => 'Guru',
            ],
            [
                'info' => 'Website',
            ],
            [
                'info' => 'Media Sosial',
            ],
            [
                'info' => 'Lain-lain',
            ],
        ]);
    }
}
