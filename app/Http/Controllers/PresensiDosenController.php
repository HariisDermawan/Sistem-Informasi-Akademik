<?php

namespace App\Http\Controllers;

use App\Models\Presensi_dosen;
use Illuminate\Http\Request;

class PresensiDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presensis = Presensi_dosen::with(['perkuliahan.matakuliah:id,nama_mk,kode_mk', 'perkuliahan.dosen:id,nama_dosen'])
            ->get();

        if ($presensis->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi dosen tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $presensis
        ], 200);
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
            'perkuliahan_id' => 'required|exists:perkuliahans,id',
            'tanggal' => 'required|date',
            'pertemuan_ke' => 'required|integer|min:1'
        ]);

        $presensi = Presensi_dosen::create($request->only(['perkuliahan_id', 'tanggal', 'pertemuan_ke']));

        return response()->json([
            'success' => true,
            'message' => 'Presensi dosen berhasil dibuat',
            'data' => $presensi->load(['perkuliahan.matakuliah:id,nama_mk,kode_mk', 'perkuliahan.dosen:id,nama_dosen'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $presensi = Presensi_dosen::with(['perkuliahan.matakuliah:id,nama_mk,kode_mk', 'perkuliahan.dosen:id,nama_dosen'])
            ->find($id);

        if (!$presensi) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi dosen tidak ditemukan!'
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
    public function edit(Presensi_dosen $presensi_dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $presensi = Presensi_dosen::findOrFail($id);

        $request->validate([
            'tanggal' => 'sometimes|required|date',
            'pertemuan_ke' => 'sometimes|required|integer|min:1',
        ]);

        $presensi->update($request->only(['tanggal', 'pertemuan_ke']));

        return response()->json([
            'success' => true,
            'message' => 'Presensi dosen berhasil diperbarui',
            'data' => $presensi->load([
                'perkuliahan.matakuliah:id,nama_mk,kode_mk',
                'perkuliahan.dosen:id,nama_dosen'
            ])
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $presensi = Presensi_dosen::find($id);
        if (!$presensi) {
            return response()->json([
                'success' => false,
                'message' => 'Presensi dosen tidak ditemukan!'
            ], 404);
        }
        $presensi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Presensi dosen berhasil dihapus'
        ], 200);
    }
}
