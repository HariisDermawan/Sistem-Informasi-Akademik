<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all();
        return view('prodi.index', compact('prodis'));
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
            'kode_prodi' => 'required|unique:prodis,kode_prodi',
            'nama_prodi' => 'required|string|max:255',
        ]);

        $prodi = Prodi::create([
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Prodi Berhasil dibuat!',
            'data' => $prodi
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prodi = Prodi::find($id);
        if (!$prodi) {
            return response()->json([
                'success' => false,
                'message' => 'Kode Prodi Tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $prodi
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json([
                'success' => false,
                'message' => 'Prodi tidak ditemukan!'
            ], 404);
        }

        $request->validate([
            'kode_prodi' => 'sometimes|required|string|max:50|unique:prodis,kode_prodi,' . $prodi->id,
            'nama_prodi' => 'sometimes|required|string|max:255',
        ]);

        $prodi->update($request->only(['kode_prodi', 'nama_prodi']));

        return response()->json([
            'success' => true,
            'message' => 'Prodi berhasil diperbarui',
            'data' => $prodi
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prodi = Prodi::find($id);
        if (!$prodi) {
            return response()->json([
                'success' => false,
                'message' => 'Prodi Tidak ditemukan!'
            ], 404);
        }

        $prodi->delete();

        return response()->json([
            'success' => true,
            'message' => 'prodi berhasil dihapus!',
            'data' => $prodi
        ], 200);
    }
}
