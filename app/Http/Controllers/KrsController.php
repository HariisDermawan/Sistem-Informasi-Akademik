<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Perkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $krs = Krs::with(['mahasiswa', 'perkuliahan.matakuliah', 'perkuliahan.dosen'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar KRS Berhasil Diambil',
            'data'    => $krs
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
        $validator = Validator::make($request->all(), [
            'mahasiswa_id'   => 'required|exists:mahasiswas,id',
            'perkuliahan_id' => 'required|exists:perkuliahans,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data input tidak valid',
                'errors'  => $validator->errors()
            ], 422);
        }

        $mhsId = $request->mahasiswa_id;
        $perkuliahanId = $request->perkuliahan_id;
        $exists = Krs::where('mahasiswa_id', $mhsId)
            ->where('perkuliahan_id', $perkuliahanId)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar pada mata kuliah ini.'
            ], 422);
        }
        $jadwalBaru = Perkuliahan::find($perkuliahanId);

        $bentrok = Krs::where('mahasiswa_id', $mhsId)
            ->whereHas('perkuliahan', function ($query) use ($jadwalBaru) {
                $query->where('hari', $jadwalBaru->hari)
                    ->where(function ($q) use ($jadwalBaru) {
                        $q->whereBetween('jam_mulai', [$jadwalBaru->jam_mulai, $jadwalBaru->jam_selesai])
                            ->orWhereBetween('jam_selesai', [$jadwalBaru->jam_mulai, $jadwalBaru->jam_selesai]);
                    });
            })->exists();

        if ($bentrok) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil KRS. Jadwal perkuliahan bentrok dengan mata kuliah lain.'
            ], 422);
        }

        $krs = Krs::create([
            'mahasiswa_id'   => $mhsId,
            'perkuliahan_id' => $perkuliahanId,
            'status'         => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil ditambahkan ke KRS.',
            'data'    => $krs
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $krs = Krs::with(['mahasiswa', 'perkuliahan.matakuliah', 'perkuliahan.dosen', 'perkuliahan.semester'])
            ->find($id);

        if (!$krs) {
            return response()->json([
                'success' => false,
                'message' => 'Data KRS tidak ditemukan!'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Detail KRS Berhasil Diambil',
            'data'    => $krs
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Krs $krs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $krs = Krs::find($id);

        if (!$krs) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
        $validator = Validator::make($request->all(), [
            'perkuliahan_id' => 'exists:perkuliahans,id',
            'status'         => 'in:pending,disetujui,ditolak'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $krs->update($request->only(['perkuliahan_id', 'status']));

        return response()->json([
            'success' => true,
            'message' => 'KRS berhasil diperbarui',
            'data'    => $krs
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $krs = Krs::find($id);

        if (!$krs) {
            return response()->json([
                'success' => false,
                'message' => 'Data KRS tidak ditemukan!'
            ], 404);
        }

        $krs->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mata kuliah berhasil dibatalkan (Drop)!'
        ], 200);
    }
}
