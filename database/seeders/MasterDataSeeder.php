<?php

namespace Database\Seeders;

use App\Models\Prodi;
use App\Models\Semester;
use App\Models\Matakuliah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $prodi = Prodi::create([
            'kode_prodi' => 'TI',
            'nama_prodi' => 'Teknik Informatika'
        ]);

        Semester::create([
            'nama_semester' => '2024 Ganjil',
            'is_aktif' => true
        ]);

        Matakuliah::create([
            'prodi_id' => $prodi->id,
            'kode_mk' => 'MK001',
            'nama_mk' => 'Pemrograman Web Laravel',
            'sks' => 3
        ]);
    }
}
