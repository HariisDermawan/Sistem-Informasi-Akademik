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
                        <h3 class="font-semibold text-gray-800">Haris Darmawan</h3>
                        <p class="text-sm text-gray-500">Admin Sistem</p>
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
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
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
                                class="ml-auto bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">{{ \App\Models\Mahasiswa::count() }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('matkul.index') }}"
                            class="flex items-center p-3 text-white rounded-lg gradient-bg">
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
                    <!-- Current Semester -->
                    <div class="hidden md:block px-4 py-2 bg-blue-50 text-blue-700 rounded-lg">
                        <span class="font-semibold">Semester:</span> Ganjil 2023/2024
                    </div>

                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button id="profileDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user-tie text-blue-600"></i>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium text-gray-800">Haris Darmawan</p>
                                <p class="text-xs text-gray-500">Admin</p>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500 text-sm hidden md:block"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileDropdown"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border py-1 z-10 hidden">
                            <div class="px-4 py-3 border-b">
                                <p class="text-sm font-medium text-gray-800">Haris Darmawan</p>
                                <p class="text-xs text-gray-500">admin@universitas.ac.id</p>
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

                <div class="bg-white rounded-xl shadow-md p-6 mb-6">

                    <!-- Header + Filter -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">
                            Daftar Mata Kuliah
                        </h2>

                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 w-full md:w-auto">
                            <div class="relative w-full sm:w-64">
                                <input type="text" placeholder="Cari mata kuliah..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <select
                                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                                <option value="3">Semester 3</option>
                                <option value="4">Semester 4</option>
                                <option value="5">Semester 5</option>
                                <option value="6">Semester 6</option>
                                <option value="7">Semester 7</option>
                                <option value="8">Semester 8</option>
                            </select>
                            <select
                                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Prodi</option>
                                <option value="ti">Teknik Informatika</option>
                                <option value="si">Sistem Informasi</option>
                                <option value="te">Teknik Elektro</option>
                                <option value="mi">Manajemen Informatika</option>
                            </select>
                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center transition duration-300"
                                onclick="document.getElementById('modal-tambah-mk').classList.remove('hidden')">
                                <i class="fas fa-plus mr-2"></i> Tambah Mata Kuliah
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Kode MK</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Nama Mata Kuliah</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">SKS</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Program Studi</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Dosen Pengampu</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($matakuliahs as $mk)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 px-4 font-medium">{{ $mk->kode_mk }}</td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                    <i class="fas fa-book text-blue-600"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-800">{{ $mk->nama_mk }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">{{ $mk->sks }}</span>
                                        </td>

                                        <td class="py-4 px-4">{{ $mk->prodi->nama_prodi ?? '-' }}</td>
                                        <td class="py-4 px-4">
                                            {{ $mk->dosen->nama_dosen ?? '-' }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex space-x-2">
                                                <a href="#"
                                                    class="text-blue-600 hover:text-blue-800 show-mk-btn"
                                                    title="Lihat Detail" data-mk='@json($mk)'>
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="javascript:void(0);"
                                                    class="text-green-600 hover:text-green-800" title="Edit"
                                                    onclick="openEditModal({{ $mk->id }}, '{{ $mk->prodi_id }}', '{{ $mk->dosen_id }}', '{{ $mk->kode_mk }}', '{{ $mk->nama_mk }}', '{{ $mk->sks }}')">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="" method="POST"
                                                    onsubmit="return confirm('Yakin hapus matakuliah ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">Belum ada data matakuliah</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-between items-center mt-6">
                        <div class="text-gray-500 text-sm">
                            Menampilkan 3 dari 78 mata kuliah
                        </div>

                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-3 py-1 bg-blue-600 text-white rounded-lg">1</button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">...</button>
                            <button
                                class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">10</button>
                            <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                </div>


                <div id="modal-edit-mk"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
                        <!-- Close Button -->
                        <button type="button" class="absolute top-3 right-3 text-white hover:text-gray-200"
                            onclick="document.getElementById('modal-edit-mk').classList.add('hidden')">
                            <i class="fas fa-times"></i>
                        </button>

                        <h2 class="text-xl font-bold text-white mb-4">Edit Mata Kuliah</h2>

                        <form id="form-edit-mk" method="POST" action="{{ route('matkul.update',  $mk->id) }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" id="edit-id">

                            <!-- Program Studi -->
                            <div class="mb-4">
                                <label class="text-white">Program Studi</label>
                                <select name="prodi_id" id="edit-prodi" required
                                    class="w-full border px-3 py-2 rounded">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach (\App\Models\Prodi::all() as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dosen Pengampu -->
                            <div class="mb-4">
                                <label class="text-white">Dosen Pengampu</label>
                                <select name="dosen_id" id="edit-dosen" class="w-full border px-3 py-2 rounded">
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::all() as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}
                                            ({{ $dosen->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kode Mata Kuliah -->
                            <div class="mb-4">
                                <label class="text-white">Kode Mata Kuliah</label>
                                <input type="text" name="kode_mk" id="edit-kode_mk" required
                                    class="w-full border px-3 py-2 rounded">
                            </div>

                            <!-- Nama Mata Kuliah -->
                            <div class="mb-4">
                                <label class="text-white">Nama Mata Kuliah</label>
                                <input type="text" name="nama_mk" id="edit-nama_mk" required
                                    class="w-full border px-3 py-2 rounded">
                            </div>

                            <!-- SKS -->
                            <div class="mb-4">
                                <label class="text-white">SKS</label>
                                <input type="number" name="sks" id="edit-sks" required min="1"
                                    max="10" class="w-full border px-3 py-2 rounded">
                            </div>

                            <!-- Buttons -->
                            <div class="flex justify-end space-x-2">
                                <button type="button" class="px-4 py-2 bg-gray-300 rounded"
                                    onclick="document.getElementById('modal-edit-mk').classList.add('hidden')">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Modal Edit Matakuliah -->
                <div id="modal-edit-mk"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative">
                        <!-- Close Button -->
                        <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                            onclick="document.getElementById('modal-edit-mk').classList.add('hidden')">
                            <i class="fas fa-times text-lg"></i>
                        </button>

                        <!-- Header -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Mata Kuliah</h2>

                        <!-- Form -->
                        <form id="form-edit-mk" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Prodi -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Program Studi</label>
                                <select name="prodi_id" id="edit-prodi" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach (\App\Models\Prodi::all() as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dosen -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Dosen Pengampu</label>
                                <select name="dosen_id" id="edit-dosen" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::all() as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}
                                            ({{ $dosen->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kode Mata Kuliah -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Kode Mata Kuliah</label>
                                <input type="text" name="kode_mk" id="edit-kode_mk" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="TI101">
                            </div>

                            <!-- Nama Mata Kuliah -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Nama Mata Kuliah</label>
                                <input type="text" name="nama_mk" id="edit-nama_mk" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Algoritma & Pemrograman">
                            </div>

                            <!-- SKS -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">SKS</label>
                                <input type="number" name="sks" id="edit-sks" required min="1"
                                    max="10"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="3">
                            </div>

                            <!-- Footer -->
                            <div class="flex justify-end space-x-2">
                                <button type="button" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300"
                                    onclick="document.getElementById('modal-edit-mk').classList.add('hidden')">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Modal Show Matakuliah -->
                <div id="modal-show-mk"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
                        <!-- Close Button -->
                        <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                            onclick="document.getElementById('modal-show-mk').classList.add('hidden')">
                            <i class="fas fa-times text-lg"></i>
                        </button>

                        <!-- Header -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Mata Kuliah</h2>

                        <!-- Content -->
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-700">Kode Mata Kuliah:</span>
                                <span id="show-kode_mk" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-700">Nama Mata Kuliah:</span>
                                <span id="show-nama_mk" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-700">SKS:</span>
                                <span id="show-sks" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-700">Program Studi:</span>
                                <span id="show-prodi" class="text-gray-800"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-700">Dosen Pengampu:</span>
                                <span id="show-dosen" class="text-gray-800"></span>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="flex justify-end mt-6">
                            <button type="button"
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg font-medium"
                                onclick="document.getElementById('modal-show-mk').classList.add('hidden')">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Modal Tambah Matakuliah -->
                <div id="modal-tambah-mk"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
                        <!-- Close button -->
                        <button class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                            onclick="document.getElementById('modal-tambah-mk').classList.add('hidden')">
                            <i class="fas fa-times"></i>
                        </button>

                        <h2 class="text-xl font-bold text-gray-800 mb-4">Tambah Mata Kuliah</h2>

                        <form action="{{ route('matkul.store') }}" method="POST">
                            @csrf

                            <!-- Prodi -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Program Studi</label>
                                <select name="prodi_id" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach (\App\Models\Prodi::all() as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dosen -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Dosen Pengampu</label>
                                <select name="dosen_id" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::all() as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}
                                            ({{ $dosen->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kode Mata Kuliah -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Kode Mata Kuliah</label>
                                <input type="text" name="kode_mk" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="TI101">
                            </div>

                            <!-- Nama Mata Kuliah -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Nama Mata Kuliah</label>
                                <input type="text" name="nama_mk" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Algoritma & Pemrograman">
                            </div>

                            <!-- SKS -->
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">SKS</label>
                                <input type="number" name="sks" required min="1" max="10"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="3">
                            </div>

                            <!-- Submit -->
                            <div class="flex justify-end space-x-2">
                                <button type="button" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300"
                                    onclick="document.getElementById('modal-tambah-mk').classList.add('hidden')">Batal</button>
                                <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                            </div>
                        </form>
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
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.show-mk-btn');

            buttons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const mk = JSON.parse(this.dataset.mk);

                    document.getElementById('show-kode_mk').textContent = mk.kode_mk;
                    document.getElementById('show-nama_mk').textContent = mk.nama_mk;
                    document.getElementById('show-sks').textContent = mk.sks;
                    document.getElementById('show-prodi').textContent = mk.prodi?.nama_prodi || '-';
                    document.getElementById('show-dosen').textContent = mk.dosen?.nama_dosen || '-';

                    document.getElementById('modal-show-mk').classList.remove('hidden');
                });
            });
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

    <script>
        function openEditModal(id, prodi_id, dosen_id, kode_mk, nama_mk, sks) {
            // Tampilkan modal
            document.getElementById('modal-edit-mk').classList.remove('hidden');

            // Isi form dengan data
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-prodi').value = prodi_id;
            document.getElementById('edit-dosen').value = dosen_id;
            document.getElementById('edit-kode_mk').value = kode_mk;
            document.getElementById('edit-nama_mk').value = nama_mk;
            document.getElementById('edit-sks').value = sks;

            // Set form action ke route update
            document.getElementById('form-edit-mk').action = '/matakuliahs/' + id;
        }
    </script>

</body>

</html>
