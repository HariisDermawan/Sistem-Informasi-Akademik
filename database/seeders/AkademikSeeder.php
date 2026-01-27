<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Perkuliahan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $dosen = Dosen::first();
        $mk = Matakuliah::first();
        $smt = Semester::first();
        $mhs = Mahasiswa::first();

        $kuliah = Perkuliahan::create([
            'matakuliah_id' => $mk->id,
            'dosen_id' => $dosen->id,
            'semester_id' => $smt->id,
            'ruangan' => 'Lab 01',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:30'
        ]);

        Krs::create([
            'mahasiswa_id' => $mhs->id,
            'perkuliahan_id' => $kuliah->id,
            'status' => 'disetujui'
        ]);
    }
}
