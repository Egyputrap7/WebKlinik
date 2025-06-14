<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin - Anasera</title>
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

<body class="min-h-screen bg-gray-50">
    <!-- Navigasi Atas -->
    <header class="text-white bg-pink-600 shadow">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
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
        <nav class="hidden px-6 py-4 text-white bg-pink-700 md:hidden" id="mobileMenu">
            <a class="block py-2 hover:text-gray-300" href="/admin/dashboard">
                Dashboard
            </a>
            <a class="block py-2 hover:text-gray-300" href="/admin/reservasi">
                Reservasi
            </a>
            <a href="{{ route('chat.index') }}">Konsultasi</a>
            <a class="block py-2 hover:text-gray-300" href="/admin/layanan">
                Layanan
            </a>
            <a class="block py-2 font-semibold underline hover:text-gray-300" href="/admin/galeri">
                Galeri
            </a>
            <a class="block py-2 hover:text-gray-300" href="/admin/akun">
                Akun
            </a>


            

        </nav>
    </header>

    <!-- Konten Dashboard -->
    <main class="container px-6 mx-auto mt-8">
    <h2 class="mb-6 text-3xl font-semibold">Dashboard</h2>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4">
        <div class="flex items-center p-6 space-x-4 transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
            <div class="p-3 text-blue-600 bg-blue-100 rounded-full">
                <i class="fas fa-calendar-check fa-2x"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Reservasi</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalReservasi }}</p>
            </div>
        </div>

        <div class="flex items-center p-6 space-x-4 transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
            <div class="p-3 text-green-600 bg-green-100 rounded-full">
                <i class="fas fa-comments fa-2x"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Konsultasi</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalKonsultasi }}</p>
            </div>
        </div>

        <div class="flex items-center p-6 space-x-4 transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
            <div class="p-3 text-yellow-600 bg-yellow-100 rounded-full">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pasien</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $totalUser }}</p>
            </div>
        </div>

        <div class="flex items-center p-6 space-x-4 transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
            <div class="p-3 text-red-600 bg-red-100 rounded-full">
                <i class="fas fa-exclamation-triangle fa-2x"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Pending Approvals</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $pendingApprovals }}</p>
            </div>
        </div>
    </div>
</main>

</body>

</html>
