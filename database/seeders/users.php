<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama'       => 'mariyam',
                'email'      => 'mariyam@gmail.com',
                'password'   => Hash::make('awasjangandiganti'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
