<?php

namespace App\Http\Controllers;

use id;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with(['user', 'prodi', 'krs.nilai'])->get();
        $mahasiswas->map(function ($mhs) {
            $totalNilai = 0;
            $jumlahMatkul = 0;
            foreach ($mhs->krs as $krs) {
                if ($krs->nilai) {
                    $totalNilai += $krs->nilai->nilai_angka;
                    $jumlahMatkul++;
                }
            }
            $mhs->ipk = $jumlahMatkul > 0 ? round($totalNilai / $jumlahMatkul, 2) : null;
            $mhs->status = $jumlahMatkul > 0 ? 'Aktif' : 'Tidak Aktif';
            return $mhs;
        });

        // Kirim data prodi ke view
        $prodis = Prodi::all();

        return view('mahasiswa.index', compact('mahasiswas', 'prodis'));
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
            'prodi_id'       => 'required|exists:prodis,id',
            'nim'            => 'required|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required|string|max:255',
            'angkatan'       => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        if ($validator->fails()) {
            return redirect()->route('mahasiswas.index') // redirect ke halaman mahasiswa
                ->withErrors($validator)
                ->withInput();
        }

        Mahasiswa::create([
            'user_id'        => Auth::id(),
            'prodi_id'       => $request->prodi_id,
            'nim'            => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'angkatan'       => $request->angkatan,
        ]);

        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
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
        // Cari mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan!');
        }

        // Validasi input
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim'            => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'prodi_id'       => 'required|exists:prodis,id',
            'angkatan'       => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        // Update data mahasiswa
        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim'            => $request->nim,
            'prodi_id'       => $request->prodi_id,
            'angkatan'       => $request->angkatan,
        ]);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan!');
        }

        $mahasiswa->krs()->delete();

        $mahasiswa->delete();

        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
