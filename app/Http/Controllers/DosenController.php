<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::with(['user:id,name,email', 'prodi:id,nama_prodi'])->get();
        $semesterAktif = Semester::where('is_aktif', 1)->first();
        return view('dosen.index', compact('dosens', 'semesterAktif', 'prodis'));
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
        $userData['password'] = bcrypt($userData['password']);

        $user = User::create($userData);

        $dosenFields = ['prodi_id', 'nidn', 'nama_dosen'];
        $dosenData = ['user_id' => $user->id];

        foreach ($dosenFields as $field) {
            if ($request->has($field)) {
                $dosenData[$field] = $request->input($field);
            }
        }

        Dosen::create($dosenData);

        return redirect()
            ->route('dosens.index')
            ->with('success', 'Dosen berhasil dibuat');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dosen = Dosen::with(['user:id,name,email', 'prodi:id,nama_prodi'])->findOrFail($id);

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

    public function update(Request $request, $id)
    {
        $dosen = Dosen::with('user')->findOrFail($id);

        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($dosen->user_id)],
            'nidn' => ['required', 'string', Rule::unique('dosens', 'nidn')->ignore($dosen->id)],
            'prodi_id' => 'required|exists:prodis,id',
            'status' => 'required|in:aktif,cuti,nonaktif',
        ]);

        // update tabel users
        $dosen->user->update([
            'email' => $request->email,
        ]);

        // update tabel dosens
        $dosen->update([
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'prodi_id' => $request->prodi_id,
            'status' => $request->status,
        ]);

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        // cek apakah dosen masih dipakai di perkuliahan
        if ($dosen->perkuliahans()->exists()) {
            return redirect()->route('dosens.index')
                ->with('error', 'Dosen tidak bisa dihapus karena masih terhubung dengan data perkuliahan!');
        }

        $dosen->delete();

        return redirect()->route('dosens.index')->with('success', 'Dosen berhasil dihapus!');
    }
}
