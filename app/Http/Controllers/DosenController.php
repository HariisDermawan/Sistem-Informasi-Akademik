<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = Dosen::with(['user:id,name,email', 'prodi:id,nama_prodi'])->get();

        return response()->json([
            'success' => true,
            'data' => $dosens
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nidn' => 'required|string|unique:dosens,nidn',
            'nama_dosen' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodis,id',
        ];
        $request->validate($rules);
        $userFields = ['name', 'email', 'password'];
        $userData = [];
        foreach ($userFields as $field) {
            if ($request->has($field)) {
                $userData[$field] = $request->input($field);
            }
        }
        $user = User::create($userData);
        $dosenFields = ['prodi_id', 'nidn', 'nama_dosen'];
        $dosenData = ['user_id' => $user->id];
        foreach ($dosenFields as $field) {
            if ($request->has($field)) {
                $dosenData[$field] = $request->input($field);
            }
        }
        $dosen = Dosen::create($dosenData);
        return response()->json([
            'success' => true,
            'message' => 'Dosen berhasil dibuat',
            'data' => $dosen->load(['user:id,name,email', 'prodi:id,nama_prodi'])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen, $id)
    {
        $dosen = Dosen::with(['user:id,name,email', 'prodi:id,nama_prodi'])->find($id);

        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dosen
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen, $id)
    {
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($dosen->user_id)],
            'password' => 'sometimes|string|min:6',
            'nidn' => ['sometimes', 'string', Rule::unique('dosens', 'nidn')->ignore($dosen->id)],
            'nama_dosen' => 'sometimes|string|max:255',
            'prodi_id' => 'sometimes|exists:prodis,id',
        ]);
        $userData = [];
        if ($request->has('name')) $userData['name'] = $request->name;
        if ($request->has('email')) $userData['email'] = $request->email;
        if ($request->has('password')) $userData['password'] = $request->password;
        if (!empty($userData)) $dosen->user()->update($userData);
        $dosenData = $request->only(['nidn', 'nama_dosen', 'prodi_id']);
        $dosen->update($dosenData);

        return response()->json([
            'success' => true,
            'message' => 'Dosen berhasil diperbarui',
            'data' => $dosen->load(['user:id,name,email', 'prodi:id,nama_prodi'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen, $id)
    {
        $dosen = Dosen::find($id);
        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan'
            ], 404);
        }
        $dosen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dosen berhasil dihapus'
        ]);
    }
}
