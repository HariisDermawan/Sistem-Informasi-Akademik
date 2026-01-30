<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Akademik - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3b82f6;
            --secondary: #1e40af;
            --accent: #10b981;
            --light: #f8fafc;
            --dark: #1e293b;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100vh;
                top: 0;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }

            .overlay.active {
                display: block;
            }
        }

        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .logout-menu {
            color: #ef4444;
        }

        .logout-menu:hover {
            background-color: rgba(239, 68, 68, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="overlay" id="overlay"></div>
    <div class="flex h-screen">
        <div class="sidebar w-64 bg-white shadow-lg z-30" id="sidebar">
            <div class="p-6 border-b">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user-tie text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-semibold text-gray-800">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-500">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
            <div class="p-4 flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span class="ml-3 font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dosens.index') }}"
                            class="flex items-center p-3 text-white rounded-lg gradient-bg">
                            <i class="fas fa-chalkboard-teacher w-6"></i>
                            <span class="ml-3">Dosen</span>
                            <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">42</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mahasiswas.index') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-user-graduate w-6"></i>
                            <span class="ml-3">Mahasiswa</span>
                            <span
                                class="ml-auto bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">1,245</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('matkul.index') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-book w-6"></i>
                            <span class="ml-3">Mata Kuliah</span>
                            <span class="ml-auto bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">78</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nilais.index') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-chart-bar w-6"></i>
                            <span class="ml-3">Nilai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perkuliahans.index') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-calendar-alt w-6"></i>
                            <span class="ml-3">Perkuliahan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-clipboard-list w-6"></i>
                            <span class="ml-3">KRS</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-user-check w-6"></i>
                            <span class="ml-3">Presensi Dosen</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-user-friends w-6"></i>
                            <span class="ml-3">Presensi Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-university w-6"></i>
                            <span class="ml-3">Program Studi</span>
                            <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">12</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-calendar w-6"></i>
                            <span class="ml-3">Semester</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b shadow-sm">
                <button id="mobileMenuBtn" class="md:hidden text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">UNIVERSITAS PAMULANG</h1>
                </div>
                <!-- Header Actions -->
                <div class="flex items-center space-x-4">
                    <div class="hidden md:block px-4 py-2 bg-blue-50 text-blue-700 rounded-lg">
                        <span class="font-semibold">Semester:</span>
                        <span>{{ $semesterAktif->nama_semester ?? '-' }}</span>
                    </div>
                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button id="profileDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user-tie text-blue-600"></i>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->name }}</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500 text-sm hidden md:block"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border py-1 z-10 hidden">
                            <div class="px-4 py-3 border-b">
                                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-3"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-3"></i>
                                <span>Pengaturan</span>
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-question-circle mr-3"></i>
                                <span>Bantuan</span>
                            </a>
                            <div class="border-t mt-1">
                                <button id="logoutHeaderBtn"
                                    class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    <span>Logout</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">Total Mahasiswa</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">1,245</h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-500 text-sm font-medium">
                                <i class="fas fa-arrow-up"></i> 5.2% dari semester lalu
                            </span>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">Total Dosen</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">42</h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-500 text-sm font-medium">
                                <i class="fas fa-arrow-up"></i> 2.4% dari semester lalu
                            </span>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">Mata Kuliah</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">78</h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-book text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-green-500 text-sm font-medium">
                                <i class="fas fa-arrow-up"></i> 3.1% dari semester lalu
                            </span>
                        </div>
                    </div>

                    <div class="card-hover bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">Program Studi</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">12</h3>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-university text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="text-gray-500 text-sm font-medium">Tidak berubah</span>
                        </div>
                    </div>
                </div>

                <!-- Table Dosen -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Data Dosen</h2>
                            <p class="text-sm text-gray-500 mt-1">Daftar dosen aktif Universitas Pamulang</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                            <div class="relative w-full sm:w-64">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" placeholder="Cari dosen..."
                                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <a href="javascript:void(0)" id="btnOpenTambahDosen"
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Dosen
                            </a>

                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4">No</th>
                                    <th class="px-6 py-4">Nama</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">NIDN</th>
                                    <th class="px-6 py-4">Program Studi</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($dosens as $index => $dosen)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-700">{{ $index + 1 }}</td>

                                        <td class="px-6 py-4 text-gray-800 font-semibold">
                                            {{ $dosen->nama_dosen ?? ($dosen->user->name ?? '-') }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $dosen->user->email ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $dosen->nidn ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $dosen->prodi->nama_prodi ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @php
                                                $status = $dosen->status ?? 'aktif';
                                            @endphp

                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-semibold
        {{ $status == 'aktif' ? 'bg-green-100 text-green-700' : '' }}
        {{ $status == 'cuti' ? 'bg-yellow-100 text-yellow-700' : '' }}
        {{ $status == 'nonaktif' ? 'bg-red-100 text-red-700' : '' }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>


                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <button type="button"
                                                    class="btnDetailDosen px-3 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition"
                                                    data-id="{{ $dosen->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <a href="javascript:void(0)"
                                                    class="btnEditDosen px-3 py-2 rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition"
                                                    data-id="{{ $dosen->id }}"
                                                    data-nama="{{ $dosen->nama_dosen }}"
                                                    data-email="{{ $dosen->user->email }}"
                                                    data-nidn="{{ $dosen->nidn }}"
                                                    data-prodi="{{ $dosen->prodi_id }}"
                                                    data-status="{{ $dosen->status ?? 'aktif' }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('dosens.destroy', $dosen->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin mau hapus dosen ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="hover:bg-gray-50">
                                        <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                                            Data dosen masih kosong.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>

                        <!-- MODAL EDIT DOSEN -->
                        <div id="modalEditDosen"
                            class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">

                            <div
                                class="bg-white rounded-xl shadow-lg w-full max-w-lg relative max-h-[90vh] overflow-y-auto">

                                <!-- Header -->
                                <div class="flex items-start justify-between px-5 py-4 border-b">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">Edit Dosen</h3>
                                        <p class="text-sm text-gray-500">Perbarui data dosen</p>
                                    </div>

                                    <button id="closeEditDosenBtn"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600">
                                        <i class="fas fa-times text-lg"></i>
                                    </button>
                                </div>

                                <!-- Body -->
                                <form id="formEditDosen" method="POST" class="px-5 py-4 space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" id="editDosenId">

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama
                                            Dosen</label>
                                        <input type="text" name="nama_dosen" id="editNamaDosen"
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                        <input type="email" name="email" id="editEmail"
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">NIDN</label>
                                        <input type="text" name="nidn" id="editNidn"
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Program
                                            Studi</label>
                                        <select name="prodi_id" id="editProdi"
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                            <option value="">-- Pilih Program Studi --</option>
                                            @foreach ($prodis ?? [] as $prodi)
                                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                                        <select name="status" id="editStatus"
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                            <option value="aktif">Aktif</option>
                                            <option value="cuti">Cuti</option>
                                            <option value="nonaktif">Nonaktif</option>
                                        </select>
                                    </div>

                                    <!-- Footer -->
                                    <div class="pt-4 border-t flex justify-end gap-3">
                                        <button type="button" id="cancelEditDosenBtn"
                                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                                            Batal
                                        </button>

                                        <button type="submit"
                                            class="px-4 py-2 rounded-lg bg-yellow-500 text-white hover:bg-yellow-600 transition">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>


                        <!-- MODAL DETAIL DOSEN -->
                        <div id="modalDetailDosen"
                            class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
                            <div
                                class="bg-white rounded-xl shadow-lg w-full max-w-lg relative max-h-[90vh] overflow-y-auto">

                                <!-- Header -->
                                <div class="flex items-start justify-between px-5 py-4 border-b">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800">Detail Dosen</h3>
                                        <p class="text-sm text-gray-500">Informasi lengkap dosen berdasarkan ID</p>
                                    </div>

                                    <button id="closeDetailDosenBtn"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600">
                                        <i class="fas fa-times text-lg"></i>
                                    </button>
                                </div>

                                <!-- Body -->
                                <div class="px-5 py-4 space-y-3 text-sm">
                                    <div class="flex justify-between gap-4 border-b pb-2">
                                        <span class="text-gray-500">Nama Dosen</span>
                                        <span id="detailNamaDosen"
                                            class="font-semibold text-gray-800 text-right break-words">
                                            -
                                        </span>
                                    </div>

                                    <div class="flex justify-between gap-4 border-b pb-2">
                                        <span class="text-gray-500">Email</span>
                                        <span id="detailEmail"
                                            class="font-semibold text-gray-800 text-right break-words">
                                            -
                                        </span>
                                    </div>

                                    <div class="flex justify-between gap-4 border-b pb-2">
                                        <span class="text-gray-500">NIDN</span>
                                        <span id="detailNidn"
                                            class="font-semibold text-gray-800 text-right break-words">
                                            -
                                        </span>
                                    </div>

                                    <div class="flex justify-between gap-4 border-b pb-2">
                                        <span class="text-gray-500">Program Studi</span>
                                        <span id="detailProdi"
                                            class="font-semibold text-gray-800 text-right break-words">
                                            -
                                        </span>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="px-5 py-4 border-t flex justify-end">
                                    <button id="closeDetailDosenBtn2"
                                        class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                                        Tutup
                                    </button>
                                </div>

                            </div>
                        </div>


                        <!-- Modal Tambah Dosen -->
                        <div id="modalTambahDosen" class="fixed inset-0 z-50 hidden">
                            <!-- Backdrop -->
                            <div class="absolute inset-0 bg-black/40"></div>

                            <!-- Modal Box -->
                            <div class="relative w-full h-full flex items-center justify-center p-4">
                                <div class="bg-white w-full max-w-lg rounded-xl shadow-lg overflow-hidden">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between px-6 py-4 border-b">
                                        <h3 class="text-lg font-bold text-gray-800">Tambah Dosen</h3>
                                        <button id="btnCloseTambahDosen"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>

                                    <form action="{{ route('dosens.store') }}" method="POST" class="p-6 space-y-4">
                                        @csrf

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama
                                                User</label>
                                            <input type="text" name="name" placeholder="Masukkan nama user"
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                            <input type="email" name="email" placeholder="contoh@unpam.ac.id"
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>

                                        <div>
                                            <label
                                                class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                                            <input type="password" name="password" placeholder="Masukkan password"
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama
                                                Dosen</label>
                                            <input type="text" name="nama_dosen" placeholder="Masukkan nama dosen"
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">NIDN</label>
                                            <input type="text" name="nidn" placeholder="Masukkan NIDN"
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Program
                                                Studi</label>
                                            <select name="prodi_id"
                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="">-- Pilih Program Studi --</option>
                                                @foreach ($prodis ?? [] as $prodi)
                                                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="flex items-center justify-end gap-3 pt-4 border-t">
                                            <button type="button" id="btnCancelTambahDosen"
                                                class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-50">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="p-6 border-t flex flex-col md:flex-row items-center justify-between gap-4">
                        <p class="text-sm text-gray-500">Menampilkan 1 - 3 dari 42 data</p>

                        <div class="flex items-center gap-2">
                            <button class="px-3 py-2 border rounded-lg hover:bg-gray-50 text-gray-600">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">1</button>
                            <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">2</button>
                            <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">3</button>
                            <button class="px-3 py-2 border rounded-lg hover:bg-gray-50 text-gray-600">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>


            </main>

            <!-- Footer -->
            <footer class="py-4 px-6 border-t bg-white">
                <div class="flex flex-col md:flex-row justify-center items-center">
                    <div class="text-gray-500 text-sm mb-2 md:mb-0">
                        &copy; 2023 Sistem Akademik Universitas Teknologi Modern
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        const modalEdit = document.getElementById("modalEditDosen");
        const closeEditBtn = document.getElementById("closeEditDosenBtn");
        const cancelEditBtn = document.getElementById("cancelEditDosenBtn");

        const formEdit = document.getElementById("formEditDosen");
        const editId = document.getElementById("editDosenId");

        const editNama = document.getElementById("editNamaDosen");
        const editEmail = document.getElementById("editEmail");
        const editNidn = document.getElementById("editNidn");
        const editProdi = document.getElementById("editProdi");
        const editStatus = document.getElementById("editStatus");

        document.querySelectorAll(".btnEditDosen").forEach(btn => {
            btn.addEventListener("click", () => {
                const id = btn.dataset.id;

                editId.value = id;
                editNama.value = btn.dataset.nama ?? '';
                editEmail.value = btn.dataset.email ?? '';
                editNidn.value = btn.dataset.nidn ?? '';
                editProdi.value = btn.dataset.prodi ?? '';
                editStatus.value = btn.dataset.status ?? 'aktif';

                // set action ke route update dosen
                formEdit.action = `/dosens/${id}`;

                modalEdit.classList.remove("hidden");
                modalEdit.classList.add("flex");
            });
        });

        function closeModalEdit() {
            modalEdit.classList.add("hidden");
            modalEdit.classList.remove("flex");
        }

        closeEditBtn.addEventListener("click", closeModalEdit);
        cancelEditBtn.addEventListener("click", closeModalEdit);

        // klik backdrop untuk close
        modalEdit.addEventListener("click", (e) => {
            if (e.target === modalEdit) closeModalEdit();
        });
    </script>


    <script>
        const modalDetailDosen = document.getElementById("modalDetailDosen");
        const closeDetailDosenBtn = document.getElementById("closeDetailDosenBtn");
        const closeDetailDosenBtn2 = document.getElementById("closeDetailDosenBtn2");

        const detailNamaDosen = document.getElementById("detailNamaDosen");
        const detailEmail = document.getElementById("detailEmail");
        const detailNidn = document.getElementById("detailNidn");
        const detailProdi = document.getElementById("detailProdi");

        function openModalDetail() {
            modalDetailDosen.classList.remove("hidden");
            modalDetailDosen.classList.add("flex");
        }

        function closeModalDetail() {
            modalDetailDosen.classList.add("hidden");
            modalDetailDosen.classList.remove("flex");
        }

        closeDetailDosenBtn.addEventListener("click", closeModalDetail);
        closeDetailDosenBtn2.addEventListener("click", closeModalDetail);

        modalDetailDosen.addEventListener("click", (e) => {
            if (e.target === modalDetailDosen) closeModalDetail();
        });

        document.querySelectorAll(".btnDetailDosen").forEach(btn => {
            btn.addEventListener("click", async () => {
                const id = btn.getAttribute("data-id");

                try {
                    const res = await fetch(`/dosens/${id}`);
                    const json = await res.json();

                    // isi modal dari response show()
                    detailNamaDosen.textContent = json.data.nama_dosen ?? "-";
                    detailEmail.textContent = json.data.user?.email ?? "-";
                    detailNidn.textContent = json.data.nidn ?? "-";
                    detailProdi.textContent = json.data.prodi?.nama_prodi ?? "-";

                    openModalDetail();
                } catch (err) {
                    alert("Gagal mengambil detail dosen!");
                    console.log(err);
                }
            });
        });
    </script>


    <script>
        const btnOpenTambahDosen = document.getElementById('btnOpenTambahDosen');
        const modalTambahDosen = document.getElementById('modalTambahDosen');
        const btnCloseTambahDosen = document.getElementById('btnCloseTambahDosen');
        const btnCancelTambahDosen = document.getElementById('btnCancelTambahDosen');

        function openModalTambahDosen() {
            modalTambahDosen.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModalTambahDosen() {
            modalTambahDosen.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        btnOpenTambahDosen.addEventListener('click', openModalTambahDosen);
        btnCloseTambahDosen.addEventListener('click', closeModalTambahDosen);
        btnCancelTambahDosen.addEventListener('click', closeModalTambahDosen);

        // klik backdrop untuk tutup
        modalTambahDosen.addEventListener('click', function(e) {
            if (e.target === modalTambahDosen) {
                closeModalTambahDosen();
            }
        });

        // ESC untuk tutup
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModalTambahDosen();
        });
    </script>


    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        const profileDropdownBtn = document.getElementById('profileDropdownBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        profileDropdownBtn.addEventListener('click', () => {
            profileDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', (e) => {
            if (!profileDropdownBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        const openLogoutModal = () => {
            logoutModal.classList.remove('hidden');
            profileDropdown.classList.add('hidden');
        };

        logoutBtn.addEventListener('click', openLogoutModal);
        logoutHeaderBtn.addEventListener('click', openLogoutModal);

        cancelLogout.addEventListener('click', () => {
            logoutModal.classList.add('hidden');
        });
    </script>
</body>

</html>
