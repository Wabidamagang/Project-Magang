<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Kaprodi;
use App\Models\User;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kaprodiData = [
            [
                'username' => 'kaprodiuser',
                'email' => 'kaprodi@example.com',
                'kode_dosen' => 'K001',
                'nip' => '123456',
            ],];

        foreach ($kaprodiData as $data) {
            $kaprodiUser = User::firstOrCreate([
                'email' => $data['email'],
            ], [
                'username' => $data['username'],
                'password' => Hash::make('password123'),
                'role' => 'kaprodi',
            ]);

            Kaprodi::firstOrCreate([
                'user_id' => $kaprodiUser->id,
            ], [
                'kode_dosen' => $data['kode_dosen'],
                'nip' => $data['nip'],
                'name' => $kaprodiUser->username,
            ]);
        }
    }
}
