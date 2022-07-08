<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            users::class,
            kontak::class,
            tahun_akademik::class,
            info_daftar::class,
            formulir::class,
            syarat::class,
            sumber_info::class,
            jalur_masuk::class,
            prodi::class,
        ]);
    }
}
