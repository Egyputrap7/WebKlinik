<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-gray-100">
    <aside class="w-64 h-screen bg-pink-600 text-white p-4 fixed">
        <h2 class="text-xl font-bold mb-4">Admin Panel</h2>
        <nav class="space-y-3">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.reservasi') }}">Reservasi</a>
            <a href="{{ route('admin.konsultasi') }}">Konsultasi</a>
            <a href="{{ route('admin.layanan') }}">Layanan</a>
            <a href="{{ route('admin.galery') }}">Galeri</a>
            <a href="{{ route('admin.akun') }}">Akun</a>
        </nav>
    </aside>

    <main class="ml-64 p-8 w-full">
        <h1 class="text-2xl font-bold mb-4">@yield('title')</h1>
        @yield('content')
    </main>
</body>

</html>
