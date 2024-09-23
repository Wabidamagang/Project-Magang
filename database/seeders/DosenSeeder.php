<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Dosen;
use App\Models\User;
use App\Models\Mahasiswa;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan 2 Dosen Wali
        for ($i = 1; $i <= 2; $i++) {
        $dosenWali = User::firstOrCreate([
            'email' => 'dosenwali' . $i . '@example.com',
        ], [
            'username' => 'dosen_wali' . $i,
            'password' => Hash::make('password123'),
            'role' => 'dosen',
        ]);

        Dosen::firstOrCreate([
            'user_id' => $dosenWali->id,
        ], [
            'kode_dosen' => 'DW00' . $i,
            'nip' => '4567' . $i,
            'name' => $dosenWali->username,
            'kelas_id' => $i,
        ]);
    }

        // Menambahkan 3 Dosen Biasa
        for ($j = 1; $j <= 3; $j++) {
        $dosenBiasa = User::firstOrCreate([
            'email' => 'dosenbiasa' . $j . '@example.com',
        ], [
            'username' => 'dosen_biasa' . $j,
            'password' => Hash::make('password123'),
            'role' => 'dosen',
        ]);

        Dosen::firstOrCreate([
            'user_id' => $dosenBiasa->id,
        ], [
            'kode_dosen' => 'DB00' . $j,
            'nip' => '4568' . $j,
            'name' => $dosenBiasa->username,
            'kelas_id' => null,
        ]);
        }
    }
}
