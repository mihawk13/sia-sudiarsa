<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'nama' => 'Pemilik',
            'username' => 'pemilik',
            'password' => bcrypt('pemilik'),
            'level' => 'Pemilik',
        ]);
        User::create([
            'nama' => 'Karyawan',
            'username' => 'karyawan',
            'password' => bcrypt('karyawan'),
            'level' => 'Karyawan',
        ]);
    }
}
