<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasData = [
            ['name' => 'Kelas A'],
            ['name' => 'Kelas B'],
        ];

        foreach ($kelasData as $kelas) {
            Kelas::firstOrCreate(['name' => $kelas['name']]);
        }
    }
}
