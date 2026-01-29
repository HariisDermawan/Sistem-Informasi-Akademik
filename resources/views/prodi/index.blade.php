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
                        <a href="{{ route('krss.index') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-clipboard-list w-6"></i>
                            <span class="ml-3">KRS</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('presensisdosens.index') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-user-check w-6"></i>
                            <span class="ml-3">Presensi Dosen</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('presensismahasiswas.index') }}"
                            class="flex items-center p-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg">
                            <i class="fas fa-user-friends w-6"></i>
                            <span class="ml-3">Presensi Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('prodis.index') }}"
                            class="flex items-center p-3 text-white rounded-lg gradient-bg">
                            <i class="fas fa-university w-6"></i>
                            <span class="ml-3">Program Studi</span>
                            <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">12</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('semesters.index') }}"
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

                <!-- PROGRAM STUDI -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Program Studi</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data program studi</p>
        </div>

        <div class="flex gap-3 mt-4 md:mt-0">
            <!-- Button Tambah Program Studi -->
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition duration-300">
                <i class="fas fa-plus mr-2"></i>
                Tambah Program Studi
            </button>
        </div>
    </div>

    <!-- Filter / Search -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="relative w-full md:w-80">
            <input type="text" placeholder="Cari kode / nama prodi / fakultas..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="text-left py-3 px-4 font-medium text-gray-700">No</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Kode Prodi</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Nama Prodi</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Fakultas</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Status</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <!-- Contoh Row -->
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-4 px-4 text-gray-700">1</td>
                    <td class="py-4 px-4 text-gray-700">TI</td>
                    <td class="py-4 px-4 text-gray-700">Teknik Informatika</td>
                    <td class="py-4 px-4 text-gray-700">Fakultas Teknik</td>
<td class="text-gray-700">
    <span class="text-green-800 font-medium bg-green-100 px-2 py-1 rounded-full text-sm">Aktif</span>
</td>
                    <td class="py-4 px-4">
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-800" title="Detail"><i class="fas fa-eye"></i></button>
                            <button class="text-green-600 hover:text-green-800" title="Edit"><i class="fas fa-edit"></i></button>
                            <button class="text-red-600 hover:text-red-800" title="Hapus"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <div class="text-gray-500 text-sm">
            Menampilkan 1 dari 12 program studi
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded-lg">1</button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</button>
            <button class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
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
