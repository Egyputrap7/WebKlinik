<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login User - ANASERA</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 110%;
        }
    </style>
</head>

<body class="bg-white text-gray-800">
    @if (auth()->check())
        <script>
            window.location.href = "/layanan";
        </script>
    @endif

    <!-- Header -->
    <header class="bg-pink-500 text-white relative">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img src="{{ asset('uploads/Logo-ANASERA-1-rev01.jpg') }}" alt="Logo ANASERA" class="w-10 h-10 mr-3" />
                <h1 class="text-2xl font-bold">ANASERA</h1>
            </div>
            <nav class="hidden md:flex space-x-6 items-center font-semibold">
                <a href="/" class="hover:text-gray-300">Home</a>
                <a href="/profile" class="hover:text-gray-300">Profile</a>
                <a href="/layanan" class="hover:text-gray-300">Layanan Pasien</a>
                <a href="/galery" class="hover:text-gray-300">Gallery</a>
                <a href="/konsultasi" class="hover:text-gray-300">Konsultasi</a>
                <div class="relative" id="login-menu-desktop">
                    <button id="login-toggle-desktop" class="flex items-center hover:text-gray-300 focus:outline-none">
                        Login <i class="fas fa-caret-down ml-1"></i>
                    </button>
                    <div id="login-dropdown-desktop"
                        class="absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded-md shadow-lg hidden z-20">
                        <a href="/admin/login" class="block px-4 py-2 hover:bg-pink-100 font-semibold">Admin</a>
                        <a href="/login" class="block px-4 py-2 hover:bg-pink-100 font-semibold">User</a>
                        <a href="/register" class="block px-4 py-2 hover:bg-pink-100 font-semibold">Register</a>
                    </div>
                </div>
            </nav>
            <button class="md:hidden focus:outline-none" id="mobile-menu-button">
                <i class="fas fa-bars text-white text-2xl"></i>
            </button>
        </div>
        <nav class="md:hidden bg-pink-500 text-white px-6 py-4 space-y-3 hidden" id="mobile-menu">
            <a href="/" class="block hover:text-gray-300 font-semibold">Home</a>
            <a href="/profile" class="block hover:text-gray-300 font-semibold">Profile</a>
            <a href="/layanan" class="block hover:text-gray-300 font-semibold">Layanan Pasien</a>
            <a href="/galery" class="block hover:text-gray-300 font-semibold">Gallery</a>
            <a href="/konsultasi" class="block hover:text-gray-300 font-semibold">Konsultasi</a>
            <div class="relative" id="login-menu-mobile">
                <button id="login-toggle-mobile"
                    class="w-full flex justify-between items-center font-semibold hover:text-gray-300 focus:outline-none">
                    Login <i class="fas fa-caret-down ml-1"></i>
                </button>
                <div id="login-dropdown-mobile" class="mt-2 space-y-2 hidden">
                    <a href="/admin/login"
                        class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100">Admin</a>
                    <a href="/login"
                        class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100">User</a>
                    <a href="/register"
                        class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100">Register</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Login Section -->
    <section class="py-16 bg-white min-h-[calc(100vh-96px)] flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-gray-100 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-center">Login User</h2>

                {{-- @if (session('error')) --}}
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">aaaaaaa
                    {{ session('error') }}
                </div>
                {{-- @endif --}}

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{ url('/auth/google') }}"
                    class="block bg-white border border-gray-300 text-gray-700 font-semibold py-2 px-4 rounded mb-4 text-center hover:bg-gray-100">
                    <i class="fab fa-google mr-2"></i> Login with Google
                </a>

                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input name="email" id="email" type="email" required
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400"
                            placeholder="Email">
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <input name="password" id="password" type="password" required
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400"
                            placeholder="Password">
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3">
                        <button type="submit"
                            class="w-full sm:w-auto bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded transition duration-200">
                            Sign In
                        </button>
                        <a href="#" class="text-pink-500 hover:text-pink-800 text-sm font-semibold">Forgot
                            Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Script Dropdown Menu -->
    <script>
        // Toggle desktop login dropdown
        document.getElementById("login-toggle-desktop").addEventListener("click", () => {
            document.getElementById("login-dropdown-desktop").classList.toggle("hidden");
        });

        // Toggle mobile login dropdown
        document.getElementById("login-toggle-mobile").addEventListener("click", () => {
            document.getElementById("login-dropdown-mobile").classList.toggle("hidden");
        });

        // Toggle burger menu
        document.getElementById("mobile-menu-button").addEventListener("click", () => {
            document.getElementById("mobile-menu").classList.toggle("hidden");
        });
    </script>
</body>

</html>
