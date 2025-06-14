<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .heading {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-yellow-100">
    <!-- Header -->
    <header class="bg-pink-500 text-white relative">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img src="{{ asset('uploads/Logo-ANASERA-1-rev01.jpg') }}" alt="Logo ANASERA" class="w-10 h-10 mr-3" />
                <h1 class="text-2xl font-bold">ANASERA</h1>
            </div>
            <nav class="hidden md:flex space-x-6 items-center font-semibold">
                <a class="hover:text-gray-300 transition-colors duration-200" href="/">Home</a>
                <a class="hover:text-gray-300 transition-colors duration-200" href="/profile">Profile</a>
                <a class="hover:text-gray-300 transition-colors duration-200" href="/layanan">Layanan Pasien</a>
                <a class="hover:text-gray-300 transition-colors duration-200" href="/galery">Gallery</a>
                <a class="hover:text-gray-300 transition-colors duration-200" href="/konsultasi">Konsultasi</a>
                @guest
                    <!-- Menu Login (Guest Only) -->
                    <div class="relative" id="login-menu-desktop">
                        <button id="login-toggle-desktop" class="flex items-center hover:text-gray-300 focus:outline-none">
                            Login <i class="fas fa-caret-down ml-1"></i>
                        </button>
                        <div id="login-dropdown-desktop"
                            class="absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded-md shadow-lg hidden z-20">
                            <a class="block px-4 py-2 hover:bg-pink-100 font-semibold" href="/admin/login">Admin</a>
                            <a class="block px-4 py-2 hover:bg-pink-100 font-semibold" href="/login">User</a>
                            <a class="block px-4 py-2 hover:bg-pink-100 font-semibold" href="/register">Register</a>
                        </div>
                    </div>
                @endguest
                @auth
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                        class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100">
                        Logout
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endauth
            </nav>
            <button class="md:hidden focus:outline-none" id="mobile-menu-button">
                <i class="fas fa-bars text-white text-2xl"></i>
            </button>
        </div>
        <nav class="md:hidden bg-pink-500 text-white px-6 py-4 space-y-3 hidden" id="mobile-menu">
            <a class="block hover:text-gray-300 font-semibold" href="/">Home</a>
            <a class="block hover:text-gray-300 font-semibold" href="/profile">Profile</a>
            <a class="block hover:text-gray-300 font-semibold" href="/layanan">Layanan</a>
            <a class="block hover:text-gray-300 font-semibold" href="/galery">Gallery</a>
            <a class="block hover:text-gray-300 font-semibold" href="/form_reservasi">Form Reservasi</a>
            <a class="block hover:text-gray-300 font-semibold" href="/konsultasi">Konsultasi</a>
            @guest
                <!-- Mobile Login Dropdown -->
                <div class="relative" id="login-menu-mobile">
                    <button id="login-toggle-mobile"
                        class="w-full flex justify-between items-center font-semibold hover:text-gray-300 focus:outline-none">
                        Login <i class="fas fa-caret-down ml-1"></i>
                    </button>
                    <div id="login-dropdown-mobile" class="mt-2 space-y-2 hidden">
                        <a class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100"
                            href="/admin/login">Admin</a>
                        <a class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100"
                            href="/login">User</a>
                        <a class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100"
                            href="/register">Register</a>
                    </div>
                </div>
            @endguest

            @auth
                <!-- Mobile Logout Button -->
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                    class="block px-4 py-2 bg-white text-pink-600 rounded font-semibold hover:bg-pink-100">
                    Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endauth
        </nav>
    </header>

    <!-- Banner -->
    <section class="relative">
        <img alt="A cozy, stylish living room with vintage decor" class="w-full h-auto"
            src="{{ asset('uploads/bersama.jpg') }}">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white">
            <h1 class="text-6xl md:text-6xl font-bold mb-4">OUR FACILITIES</h1>
        </div>
    </section>

    <!-- Resepsionis -->
    <section class="bg-yellow-200 py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="relative w-3/4 mx-auto">
                    <img alt="A person named Peaches sitting in a stylish room"
                        class="w-full h-auto border-8 border-yellow-500" src="{{ asset('uploads/Resepsionis.jpg') }}" />
                    <div class="absolute top-2 left-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
                <div>
                    <h3 class="heading text-3xl md:text-4xl text-green-800 mb-4">RESEPSIONIS</h3>
                    <p class="text-2xl mb-4">Langkah pertama dimulai dengan sambutan hangat dan senyum yang tulus</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Ruang Tunggu -->
    <section class="bg-orange-600 py-16">
        <div class="container mx-auto px-4 text-white">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="heading text-3xl md:text-4xl mb-4">RUANG TUNGGU</h3>
                    <p class="text-2xl mb-4">Tempat istirahat sejenak sambil menenangkan hati dan pikiran</p>
                </div>
                <div class="relative w-3/4 mx-auto">
                    <img alt="A stylish vintage kitchen with a red fridge"
                        class="w-full h-auto border-8 border-yellow-500"
                        src="{{ asset('uploads/ruang_tunggu.jpg') }}" />
                    <div class="absolute top-2 right-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tempat Bermain Anak -->
    <section class="py-16" style="background-color: #b3d085;">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="relative w-3/4 mx-auto">
                    <img alt="A person named Peaches sitting in a stylish room"
                        class="w-full h-auto border-8 border-yellow-500"
                        src="{{ asset('uploads\tempat_bermain.jpg') }}" />
                    <div class="absolute top-2 left-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
                <div>
                    <h3 class="heading text-3xl md:text-4xl text-green-800 mb-4">Tempat Bermain Anak </h3>
                    <p class="text-2xl mb-4">Di sini, anak-anak bebas tertawa, bermain, dan jadi diri sendiri</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ruang konsultasi -->
    <section class="py-16" style="background-color: #bb91ef;">
        <div class="container mx-auto px-4 text-white">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="heading text-3xl md:text-4xl mb-4">Ruang Konsultasi</h3>
                    <p class="text-2xl mb-4">Di sini, orang tua dan tenaga ahli duduk bersama, saling berbagi cerita
                        demi tumbuh kembang terbaik untuk anak tercinta</p>
                </div>
                <div class="relative w-3/4 mx-auto">
                    <img alt="A stylish vintage kitchen with a red fridge"
                        class="w-full h-auto border-8 border-yellow-500"
                        src="{{ asset('uploads/ruang_konsultasi.jpg') }}" />
                    <div class="absolute top-2 right-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ruang terapi wicara -->
    <section class="py-16" style="background-color: #ffabab;">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="relative w-3/4 mx-auto">
                    <img alt="A person named Peaches sitting in a stylish room"
                        class="w-full h-auto border-8 border-yellow-500"
                        src="{{ asset('uploads\ruang_terapiwicara.jpg') }}" />
                    <div class="absolute top-2 left-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
                <div>
                    <h3 class="heading text-3xl md:text-4xl text-green-800 mb-4">Ruang Terapi Wicara </h3>
                    <p class="text-2xl mb-4">Langkah bicara pertama dimulai dari sini, bersama perhatian dan kesabaran
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--Ruang Sensori Integrasi -->
    <section class="py-16" style="background-color: #8ca6fc;">
        <div class="container mx-auto px-4 text-white">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="heading text-3xl md:text-4xl mb-4">Ruang Sensori Integrasi</h3>
                    <p class="text-2xl mb-4">Ruangan ceria penuh warna, tempat anak bermain sambil belajar mengenal
                        dunia dengan sentuhan, suara, dan gerakan</p>
                </div>
                <div class="relative w-3/4 mx-auto">
                    <img alt="A stylish vintage kitchen with a red fridge"
                        class="w-full h-auto border-8 border-yellow-500"
                        src="{{ asset('uploads/ruang_sensoriIntegrasi.jpg') }}" />
                    <div class="absolute top-2 right-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ruang Okupasi Terapi -->
    <section class="py-16" style="background-color: #eee2e2;">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="relative w-3/4 mx-auto">
                    <img alt="A person named Peaches sitting in a stylish room"
                        class="w-full h-auto border-8 border-yellow-500"
                        src="{{ asset('uploads\ruang_okupasi.jpg') }}" />
                    <div class="absolute top-2 left-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
                <div>
                    <h3 class="heading text-3xl md:text-4xl text-green-800 mb-4">Ruang Okupasi Terapi</h3>
                    <p class="text-2xl mb-4">Dengan penuh kesabaran, anak diajak belajar melakukan hal-hal kecil yang
                        berarti besar
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--Ruang Fisioterapi -->
    <section class="py-16" style="background-color: #dd9595;">
        <div class="container mx-auto px-4 text-white">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h3 class="heading text-3xl md:text-4xl mb-4">Ruang Fisioterapi</h3>
                    <p class="text-2xl mb-4">Melalui gerakan sederhana, anak belajar menjadi lebih kuat setiap harinya
                    </p>
                </div>
                <div class="relative w-3/4 mx-auto">
                    <img alt="A stylish vintage kitchen with a red fridge"
                        class="w-full h-auto border-8 border-yellow-500"
                        src="{{ asset('uploads/ruang_fisioterapi.jpg') }}" />
                    <div class="absolute top-2 right-2 bg-yellow-500 p-2 rounded-full">
                        <i class="fas fa-star text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
