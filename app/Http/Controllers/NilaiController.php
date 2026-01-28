<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilais = Nilai::with([
            'krs.mahasiswa:id,nama_mahasiswa,nim',
            'krs.perkuliahan.matakuliah:id,nama_mk,kode_mk'
        ])->get();

        if ($nilais->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $nilais
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
            'krs_id' => 'required|exists:krs,id',
            'nilai_angka' => 'nullable|numeric|min:0|max:100',
            'nilai_huruf' => 'nullable|string|max:2'
        ]);
        $nilai = Nilai::create($request->only([
            'krs_id',
            'nilai_angka',
            'nilai_huruf'
        ]));
        return response()->json([
            'success' => true,
            'message' => 'Nilai Berhasil dibuat',
            'data' => $nilai
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nilai = Nilai::with([
            'krs.mahasiswa:id,nama_mahasiswa,nim',
            'krs.perkuliahan.matakuliah:id,nama_mk,kode_mk'
        ])->find($id);

        if (!$nilai) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai Tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $nilai
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);
        if (!$nilai) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai Tidak ditemukan!'
            ], 404);
        }
        $request->validate([
            'nilai_angka' => 'nullable|numeric|min:0|max:100',
            'nilai_huruf' => 'nullable|string|max:2'
        ]);
        $nilai->update($request->only([
            'nilai_angka',
            'nilai_huruf'
        ]));
        return response()->json([
            'success' => true,
            'message' => 'Nilai Berhasil di update',
            'data' => $nilai
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nilai = Nilai::find($id);
        if (!$nilai) {
            return response()->json([
                'success' => false,
                'message' => 'nilai tidak ditemukan!'
            ], 404);
        }
        $nilai->delete();
        return response()->json([
            'success' => true,
            'data' => $nilai
        ], 200);
    }
}
