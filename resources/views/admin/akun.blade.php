<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Akun Admin - Ubah Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 110%;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Navigasi Atas -->
    <header class="bg-pink-600 text-white shadow">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img src="{{ asset('uploads/Logo-ANASERA-1-rev01.jpg') }}" alt="Logo ANASERA" class="w-10 h-10 mr-3">
                <h1 class="text-2xl font-bold">ANASERA Admin</h1>
            </div>
            <nav class="hidden space-x-6 md:flex">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                <a href="{{ route('admin.reservasi') }}" class="hover:text-gray-300">Reservasi</a>
                <a href="{{ route('chat.index') }}">Konsultasi</a>
                <a href="{{ route('admin.layanan') }}" class="hover:text-gray-300">Layanan</a>
                <a href="{{ route('admin.galery') }}" class="hover:text-gray-300">Galeri</a>
                <a href="{{ route('admin.akun') }}" class="hover:text-gray-300">Akun</a>
            
                <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            </nav>
        </div>
        <nav class="md:hidden bg-pink-700 text-white px-6 py-4 hidden" id="mobileMenu">
            <a class="block py-2 hover:text-gray-300" href="/admin/dashboard">
                Dashboard
            </a>
            <a class="block py-2 hover:text-gray-300" href="/admin/reservasi">
                Reservasi
            </a>
            <a class="block py-2 hover:text-gray-300" href="/admin/konsultasi">
                Konsultasi
            </a>
            <a class="block py-2 hover:text-gray-300" href="/admin/layanan">
                Layanan
            </a>
            <a class="block py-2 hover:text-gray-300 font-semibold underline" href="/admin/galery">
                Galeri
            </a>
            <a class="block py-2 hover:text-gray-300" href="/admin/akun">
                Akun
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="hover:text-gray-300">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </nav>
    </header>

    <!-- Konten Ubah Password -->
    <main class="flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8 mt-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Ubah Password Admin</h1>
            <form method="POST" action="/admin/password/update" class="space-y-6">
                @csrf
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:border-pink-600 transition"
                        placeholder="Masukkan password baru Anda" autocomplete="new-password" />
                </div>
                <button type="submit"
                    class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition">
                    Ubah Password
                </button>
            </form>
        </div>
    </main>
</body>

</html>
