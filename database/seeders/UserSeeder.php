<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $prodi = Prodi::first();

        // Admin
        $admin = User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@siakad.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        // Dosen
        $uDosen = User::create([
            'name' => 'Dosen Pengajar, S.T',
            'email' => 'dosen@siakad.com',
            'password' => bcrypt('password')
        ]);
        $uDosen->assignRole('dosen');
        Dosen::create([
            'user_id' => $uDosen->id,
            'prodi_id' => $prodi->id,
            'nidn' => '00112233',
            'nama_dosen' => $uDosen->name
        ]);

        // Mahasiswa
        $uMhs = User::create([
            'name' => 'Budi Mahasiswa',
            'email' => 'mhs@siakad.com',
            'password' => bcrypt('password')
        ]);
        $uMhs->assignRole('mahasiswa');
        Mahasiswa::create([
            'user_id' => $uMhs->id,
            'prodi_id' => $prodi->id,
            'nim' => '2024001',
            'nama_mahasiswa' => $uMhs->name,
            'angkatan' => 2024
        ]);
    }
}
