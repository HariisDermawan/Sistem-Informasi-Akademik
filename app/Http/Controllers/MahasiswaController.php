<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi'])->get();

        if ($mahasiswa->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Daftar mahasiswa masih kosong!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Mahasiswa',
            'data'    => $mahasiswa
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
            'user_id'        => 'required|exists:users,id',
            'prodi_id'       => 'required|exists:prodis,id',
            'nim'            => 'required|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required|string|max:255',
            'angkatan'       => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $mahasiswa = Mahasiswa::create($request->all());

        if ($mahasiswa) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Disimpan',
                'data'    => $mahasiswa
            ], 201);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi'])->find($id);
        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak ditemukan!'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'user_id'        => 'sometimes|required|exists:users,id',
            'prodi_id'       => 'sometimes|required|exists:prodis,id',
            'nim'            => 'sometimes|required|unique:mahasiswas,nim,' . $id,
            'nama_mahasiswa' => 'sometimes|required|string|max:255',
            'angkatan'       => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Update Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }
        $mahasiswa->update($request->all());

        $mahasiswa = $mahasiswa->fresh(['user', 'prodi']);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diperbarui',
            'data'    => $mahasiswa
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak ditemukan!'
            ], 404);
        }
        $mahasiswa->krs()->delete();
        if ($mahasiswa->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Mahasiswa dan KRS terkait berhasil dihapus'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus data!'
        ], 500);
    }
}
