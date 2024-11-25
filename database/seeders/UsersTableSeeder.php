<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'no_hp' => 6280000000000,
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Karyawan Satu',
                'email' => 'karyawan1@gmail.com',
                'password' => Hash::make('karyawan'),
                'no_hp' => 6280000000001,
                'role' => 'karyawan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Karyawan Dua',
                'email' => 'karyawan2@gmail.com',
                'password' => Hash::make('karyawan'),
                'no_hp' => 6280000000002,
                'role' => 'karyawan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Karyawan Tiga',
                'email' => 'karyawan3@gmail.com',
                'password' => Hash::make('karyawan'),
                'no_hp' => 6280000000003,
                'role' => 'karyawan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Karyawan Empat',
                'email' => 'karyawan4@gmail.com',
                'password' => Hash::make('karyawan'),
                'no_hp' => 6280000000004,
                'role' => 'karyawan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Karyawan Lima',
                'email' => 'karyawan5@gmail.com',
                'password' => Hash::make('karyawan'),
                'no_hp' => 6280000000005,
                'role' => 'karyawan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
