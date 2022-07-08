<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tahun_akademik extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tahun_akademik')->insert([
            [
                'tahun' => '2022 / 2023',
                'status' => '1',
            ]
        ]);
    }
}
