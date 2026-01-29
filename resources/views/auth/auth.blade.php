<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Akademik</title>
    <link rel="stylesheet" href="{{ asset('css/stayle.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center p-4" style="background-image: url('{{ asset('img/1.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 100vh;">
    <div class="login-container w-full">
        <div class="rounded-2xl bg-white backdrop-blur-sm shadow-2xl w-full max-w-md mx-auto overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 h-2 w-full"></div>
            <div class="p-8">
                <div class="flex justify-between items-start mb-8">
                    <div class="flex-1">
                        <img src="{{ asset('img/sasmita.png') }}" alt="Logo SMK Sasmita" class="h-16 w-auto">
                    </div>
                    <div class="flex-1 flex justify-end">
                        <img src="{{ asset('img/unpam.png') }}" alt="Logo UNPAM" class="h-16 w-auto">
                    </div>
                </div>

                <div class="text-center mb-8 mt-8">
                    <h2 class="text-2xl font-bold text-gray-800">LOGIN SISTEM AKADEMIK</h2>
                    <p class="text-gray-600 mt-1">UNIVERSITAS PAMULANG</p>
                    <div class="w-100 h-1 bg-blue-600 mx-auto mt-3 rounded-full"></div>
                </div>

                <!-- PESAN ERROR / SUKSES -->
                @if (session('error'))
                    <div id="loginMessage" class="mb-4 text-red-600 font-semibold text-center">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div id="loginMessage" class="mb-4 text-red-600 font-semibold text-center">
                        Login gagal! Email atau password salah.
                    </div>
                @endif

                @if (session('success'))
                    <div id="loginMessage" class="mb-4 text-green-600 font-semibold text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- FORM LOGIN -->
                <form id="loginForm" class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Username</label>
                        <input type="email" name="email" placeholder="username / nim"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Masukkan password"
                                   class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   required>
                        </div>
                    </div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3.5 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        MASUK SISTEM
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-gray-500 text-sm">
                        Sistem Informasi Akademik Terpadu
                    </p>
                    <p class="text-gray-400 text-xs mt-2">
                        © 2024 SMK Sasmita & Universitas Pamulang
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT HILANGKAN PESAN OTOMATIS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const msg = document.getElementById('loginMessage');
            if(msg) {
                setTimeout(() => {
                    msg.style.transition = "opacity 0.5s";
                    msg.style.opacity = 0;
                    setTimeout(() => msg.remove(), 500);
                }, 5000); // hilang setelah 5 detik
            }
        });
    </script>
</body>
<script src="{{ asset('js/main.js') }}"></script>
</html>
