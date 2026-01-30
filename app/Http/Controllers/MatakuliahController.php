<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matakuliahs = Matakuliah::with(['prodi', 'dosen'])->get();
        return view('matakuliah.index', compact('matakuliahs'));
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
            'prodi_id' => 'required|exists:prodis,id',
            'dosen_id' => 'nullable|exists:dosens,id',
            'kode_mk'  => 'required|string|unique:matakuliahs,kode_mk',
            'nama_mk'  => 'required|string|max:255',
            'sks'      => 'required|integer|min:1|max:10',
        ]);

        $mk = Matakuliah::create($request->only([
            'prodi_id',
            'dosen_id',
            'kode_mk',
            'nama_mk',
            'sks',
        ]));

        return redirect()->route('matakuliahs.index')
            ->with('success', 'Data Matakuliah berhasil ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mk = Matakuliah::with(['prodi:id,nama_prodi'])->find($id);

        if (!$mk) {
            return response()->json([
                'success' => false,
                'message' => 'Matakuliah tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mk
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mk = Matakuliah::find($id);

        if (!$mk) {
            return response()->json([
                'success' => false,
                'message' => 'Matakuliah tidak ditemukan!'
            ], 404);
        }

        $request->validate([
            'prodi_id' => 'sometimes|exists:prodis,id',
            'kode_mk' => ['sometimes', 'string', Rule::unique('matakuliahs', 'kode_mk')->ignore($mk->id)],
            'nama_mk' => 'sometimes|string|max:255',
            'sks' => 'sometimes|integer|min:1|max:10'
        ]);

        $mk->update($request->only(['prodi_id', 'kode_mk', 'nama_mk', 'sks']));

        return response()->json([
            'success' => true,
            'message' => 'Matakuliah berhasil diperbarui',
            'data' => $mk->load('prodi:id,nama_prodi')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mk = Matakuliah::find($id);
        if (!$mk) {
            return response()->json([
                'success' => false,
                'message' => 'Matakulaih tidak ditemukan!'
            ], 404);
        }

        $mk->delete();

        return response()->json([
            'success' => true,
            'message' => 'matakuliah berhasil dihapus!'
        ], 200);
    }
}
