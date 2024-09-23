<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Kelas;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($k = 1; $k <= 2; $k++) { // 2 kelas
            for ($m = 1; $m <= 10; $m++) { // 10 mahasiswa per kelas
                $mahasiswa = User::firstOrCreate([
                    'email' => 'mahasiswa' . (($k - 1) * 10 + $m) . '@example.com',
                ], [
                    'username' => 'mahasiswa' . (($k - 1) * 10 + $m),
                    'password' => Hash::make('password123'),
                    'role' => 'mahasiswa',
                ]);
    
                Mahasiswa::firstOrCreate([
                    'user_id' => $mahasiswa->id,
                ], [
                    'nim' => 'M00' . (($k - 1) * 10 + $m),
                    'name' => $mahasiswa->username,
                    'kelas_id' => $k,
                    'tempat_lahir' => 'Tempat Lahir',
                    'tanggal_lahir' => now(),
                    'edit' => 0,
                ]);
            }
        }
    }
}
