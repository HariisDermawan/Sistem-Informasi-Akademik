<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::all();
        return view('semester.index', compact('semesters'));
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
            'nama_semester' => 'required|string|max:255',
            'is_aktif' => 'sometimes|boolean',
        ]);

        if ($request->is_aktif) {
            Semester::with('is_aktif', true)->update(['is_aktif' => false]);
        }

        $semester = Semester::create($request->only(['nama_semester', 'is_aktif']));
        return response()->json([
            'success' => true,
            'message' => 'Semester berhasil dibuat!',
            'data' => $semester
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'success' => false,
                'message' => 'Semester Tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $semester
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'success' => false,
                'message' => 'Semester tidak ditemukan!'
            ], 404);
        }

        $request->validate([
            'nama_semester' => 'sometimes|string|max:255',
            'is_aktif' => 'sometimes|boolean',
        ]);

        if ($request->has('is_aktif') && $request->is_aktif) {
            Semester::where('is_aktif', true)->where('id', '!=', $semester->id)->update(['is_aktif' => false]);
        }

        $semester->update($request->only(['nama_semester', 'is_aktif']));

        return response()->json([
            'success' => true,
            'message' => 'Semester berhasil diperbarui!',
            'data' => $semester
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'success' => false,
                'message' => 'Semester tidak ditemukan!'
            ], 404);
        }

        $semester->delete();

        return response()->json([
            'success' => true,
            'message' => 'Semester berhasil dihapus!',
            'data' => $semester,
        ], 200);
    }
}
