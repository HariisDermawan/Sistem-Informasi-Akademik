<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $semesterAktif = Semester::where('is_aktif', 1)->first();
        return view('dashboard', compact('totalMahasiswa', 'semesterAktif'));
    }
}
