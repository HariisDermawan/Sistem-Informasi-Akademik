<?php

namespace App\Http\Controllers;

use App\Models\Perkuliahan;
use Illuminate\Http\Request;

class PerkuliahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perkuliahans = Perkuliahan::with([
            'matakuliah:id,kode_mk,nama_mk',
            'dosen:id,nama_dosen',
            'semester:id,nama_semester'
        ])->get();
        if ($perkuliahans->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Perkulihan tidak ditemukan!'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data'    => $perkuliahans
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
            'matakuliah_id' => 'required|exists:matakuliahs,id',
            'dosen_id' => 'required|exists:dosens,id',
            'semester_id' => 'required|exists:semesters,id',
            'ruangan' => 'required|string|max:50',
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
        ]);

        $perkuliahan = Perkuliahan::create($request->only([
            'matakuliah_id',
            'dosen_id',
            'semester_id',
            'ruangan',
            'hari',
            'jam_mulai',
            'jam_selesai'
        ]));
        return response()->json([
            'success' => true,
            'message' => 'Perkuliahan berhasil dibuat',
            'data' => $perkuliahan->load([
                'matakuliah:id,kode_mk,nama_mk',
                'dosen:id,nama_dosen',
                'semester:id,nama_semester'
            ])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $perkuliahan = Perkuliahan::with([
            'matakuliah:id,kode_mk,nama_mk',
            'dosen:id,nama_dosen',
            'semester:id,nama_semester'
        ])->find($id);

        if (!$perkuliahan) {
            return response()->json([
                'success' => false,
                'message' => 'Perkuliahan tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $perkuliahan
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perkuliahan $perkuliahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $perkuliahan = Perkuliahan::find($id);

        if (!$perkuliahan) {
            return response()->json([
                'success' => false,
                'message' => 'Perkuliahan tidak ditemukan!'
            ], 404);
        }

        $request->validate([
            'matakuliah_id' => 'sometimes|exists:matakuliahs,id',
            'dosen_id' => 'sometimes|exists:dosens,id',
            'semester_id' => 'sometimes|exists:semesters,id',
            'ruangan' => 'sometimes|string|max:50',
            'hari' => 'sometimes|string|max:20',
            'jam_mulai' => 'sometimes|date_format:H:i',
            'jam_selesai' => 'sometimes|date_format:H:i|after:jam_mulai'
        ]);

        $perkuliahan->update($request->only([
            'matakuliah_id',
            'dosen_id',
            'semester_id',
            'ruangan',
            'hari',
            'jam_mulai',
            'jam_selesai'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Perkuliahan berhasil diperbarui',
            'data' => $perkuliahan->load([
                'matakuliah:id,kode_mk,nama_mk',
                'dosen:id,nama_dosen',
                'semester:id,nama_semester'
            ])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $perkuliahan = Perkuliahan::with('krs')->find($id);

        if (!$perkuliahan) {
            return response()->json([
                'success' => false,
                'message' => 'Perkuliahan tidak ditemukan!'
            ], 404);
        }
        if ($perkuliahan->krs()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Perkuliahan ini tidak bisa dihapus karena masih memiliki KRS aktif.'
            ], 400);
        }
        $perkuliahan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Perkuliahan berhasil dihapus'
        ], 200);
    }
}
