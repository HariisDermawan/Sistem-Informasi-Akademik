<?php

namespace App\Http\Controllers;

use App\Models\Presensi_mahasiswa;
use Illuminate\Http\Request;

class PresensiMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensis = Presensi_mahasiswa::with([
            'krs.mahasiswa:id,nama_mahasiswa,nim',
            'presensi_dosen.perkuliahan.matakuliah:id,nama_mk,kode_mk',
            'presensi_dosen.perkuliahan.dosen:id,nama_dosen'
        ])->get();
        return view('presensiMhs.index', compact('presensis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'krs_id' => 'required|exists:krs,id',
            'presensi_dosen_id' => 'required|exists:presensi_dosens,id',
            'status' => 'required|in:hadir,sakit,izin,alfa'
        ]);

        $presensi = Presensi_mahasiswa::create($request->only(['krs_id', 'presensi_dosen_id', 'status']));

        return response()->json([
            'success' => true,
            'message' => 'Presensi mahasiswa berhasil dibuat',
            'data' => $presensi->load([
                'krs.mahasiswa:id,nama_mahasiswa,nim',
                'presensi_dosen.perkuliahan.matakuliah:id,nama_mk,kode_mk',
                'presensi_dosen.perkuliahan.dosen:id,nama_dosen'
            ])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $presensi = Presensi_mahasiswa::with([
            'krs.mahasiswa:id,nama_mahasiswa,nim',
            'presensi_dosen.perkuliahan.matakuliah:id,nama_mk,kode_mk',
            'presensi_dosen.perkuliahan.dosen:id,nama_dosen'
        ])->find($id);

        if (!$presensi) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi mahasiswa tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $presensi
        ], 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi_mahasiswa $presensi_mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $presensi = Presensi_mahasiswa::findOrFail($id);

        $request->validate([
            'status' => 'sometimes|required|in:hadir,sakit,izin,alfa'
        ]);

        $presensi->update($request->only(['status']));

        return response()->json([
            'success' => true,
            'message' => 'Presensi mahasiswa berhasil diperbarui',
            'data' => $presensi->load([
                'krs.mahasiswa:id,nama_mahasiswa,nim',
                'presensi_dosen.perkuliahan.matakuliah:id,nama_mk,kode_mk',
                'presensi_dosen.perkuliahan.dosen:id,nama_dosen'
            ])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $presensi = Presensi_mahasiswa::findOrFail($id);
        $presensi->delete();
        return response()->json([
            'success' => true,
            'message' => 'Presensi mahasiswa berhasil dihapus'
        ], 200);
    }
}
