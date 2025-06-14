<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembangan Website ANASERA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .bold-border {
            border: 2px solid rgb(0, 0, 0);
        }
    </style>
</head>

<body class="text-gray-800 bg-white">
    <!-- Header -->
    <header class="relative text-white bg-pink-500">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <img src="{{ asset('uploads/Logo-ANASERA-1-rev01.jpg') }}" alt="Logo ANASERA" class="w-10 h-10 mr-3" />
                <h1 class="text-2xl font-bold">ANASERA</h1>
            </div>
            <nav class="items-center hidden space-x-6 font-semibold md:flex">
                <a class="transition-colors duration-200 hover:text-gray-300" href="/">Home</a>
                <a class="transition-colors duration-200 hover:text-gray-300" href="/profile">Profile</a>
                <a class="transition-colors duration-200 hover:text-gray-300" href="/layanan">Layanan Pasien</a>
                <a class="transition-colors duration-200 hover:text-gray-300" href="/galery">Gallery</a>
                <a class="transition-colors duration-200 hover:text-gray-300" href="/konsultasi">Konsultasi</a>
                @guest
                    <!-- Menu Login (Guest Only) -->
                    <div class="relative" id="login-menu-desktop">
                        <button id="login-toggle-desktop" class="flex items-center hover:text-gray-300 focus:outline-none">
                            Login <i class="ml-1 fas fa-caret-down"></i>
                        </button>
                        <div id="login-dropdown-desktop"
                            class="absolute right-0 z-20 hidden w-40 mt-2 text-gray-800 bg-white rounded-md shadow-lg">
                            <a class="block px-4 py-2 font-semibold hover:bg-pink-100" href="/admin/login">Admin</a>
                            <a class="block px-4 py-2 font-semibold hover:bg-pink-100" href="/login">User</a>
                            <a class="block px-4 py-2 font-semibold hover:bg-pink-100" href="/register">Register</a>
                        </div>
                    </div>
                @endguest
                @auth
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                        class="block px-4 py-2 font-semibold text-pink-600 bg-white rounded hover:bg-pink-100">
                        Logout
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endauth
            </nav>
            <button class="md:hidden focus:outline-none" id="mobile-menu-button">
                <i class="text-2xl text-white fas fa-bars"></i>
            </button>
        </div>
        <nav class="hidden px-6 py-4 space-y-3 text-white bg-pink-500 md:hidden" id="mobile-menu">
            <a class="block font-semibold hover:text-gray-300" href="/">Home</a>
            <a class="block font-semibold hover:text-gray-300" href="/profile">Profile</a>
            <a class="block font-semibold hover:text-gray-300" href="/layanan">Layanan</a>
            <a class="block font-semibold hover:text-gray-300" href="/galery">Gallery</a>
            <a class="block font-semibold hover:text-gray-300" href="/form_reservasi">Form Reservasi</a>
            <a class="block font-semibold hover:text-gray-300" href="/konsultasi">Konsultasi</a>
            @guest
                <!-- Mobile Login Dropdown -->
                <div class="relative" id="login-menu-mobile">
                    <button id="login-toggle-mobile"
                        class="flex items-center justify-between w-full font-semibold hover:text-gray-300 focus:outline-none">
                        Login <i class="ml-1 fas fa-caret-down"></i>
                    </button>
                    <div id="login-dropdown-mobile" class="hidden mt-2 space-y-2">
                        <a class="block px-4 py-2 font-semibold text-pink-600 bg-white rounded hover:bg-pink-100"
                            href="/admin/login">Admin</a>
                        <a class="block px-4 py-2 font-semibold text-pink-600 bg-white rounded hover:bg-pink-100"
                            href="/login">User</a>
                        <a class="block px-4 py-2 font-semibold text-pink-600 bg-white rounded hover:bg-pink-100"
                            href="/register">Register</a>
                    </div>
                </div>
            @endguest

            @auth
                <!-- Mobile Logout Button -->
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                    class="block px-4 py-2 font-semibold text-pink-600 bg-white rounded hover:bg-pink-100">
                    Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endauth
        </nav>
    </header>

    <!-- Jadwal Tersedia -->
    @php
        use Carbon\Carbon;
    @endphp

    <section class="p-6 mx-4 mb-12 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-2xl font-bold">Jadwal Layanan</h2>

        <table class="w-full text-sm font-medium text-left text-gray-700 border border-gray-200">
            <thead class="text-gray-500 bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Hari/Tanggal</th>
                    <th class="px-4 py-2 border">Kuota Tersedia</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Jam Operasional</th>
                    <th class="px-4 py-2 border">Reservasi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($dates as $index => $date)
                    @php
                        $carbonDate = \Carbon\Carbon::parse($date['date'])->locale('id');
                    @endphp
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-3 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $carbonDate->translatedFormat('l, d/m/Y') }}</td>

                        {{-- Kolom Kuota --}}
                        <td class="px-4 py-2 border">
                            {{ $date['quota_label'] ?? '-' }}
                        </td>

                        {{-- Kolom Status --}}
                       
                        <td class="px-4 py-2 border">
                            {{ $date['status'] ?? '-' }}
                        </td>

                        {{-- Jam Operasional --}}
                        <td class="px-4 py-2 border">{{ $date['hours'] ?? '-' }}</td>

                        {{-- Tombol Reservasi --}}
                        <td class="px-4 py-2 border">
                            @auth
                                @if (!($date['is_full'] ?? false) && $date['status'] === 'Buka')
                                    <a href="{{ route('reservasi.create', $date['date']) }}"
                                        class="px-3 py-1 text-sm text-white bg-purple-600 rounded-md hover:bg-purple-700">
                                        Reservasi
                                    </a>
                                @else
                                    <button disabled
                                        class="px-3 py-1 text-sm text-white bg-purple-300 rounded-md cursor-not-allowed">
                                        Reservasi
                                    </button>
                                @endif
                            @else
                                <a href="{{ url('/login') }}"
                                    onclick="return confirm('Silakan login terlebih dahulu untuk melakukan reservasi.')"
                                    class="px-3 py-1 text-sm text-white bg-purple-600 rounded-md hover:bg-purple-700">
                                    Reservasi
                                </a>
                            @endauth
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
    </section>

    <!-- Success Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50" id="successModal">
        <div class="max-w-md p-6 mx-4 bg-white rounded shadow-md">
            <h2 class="mb-2 text-xl font-semibold text-green-600 select-none">Berhasil!</h2>
            <p class="mb-4 text-gray-700 select-none" id="successMessage">Reservasi Anda telah berhasil.</p>
            <button class="w-full px-4 py-2 mt-4 text-white bg-green-600 rounded select-none hover:bg-green-700"
                onclick="document.getElementById('successModal').classList.add('hidden')">
                Tutup
            </button>
        </div>
    </div>

    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <!-- Our Services Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="mb-4 text-3xl font-bold">Our Services</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Konsultasi Tumbuh Kembang Anak -->
                <div
                    class="p-6 transition transform bg-purple-200 rounded-lg shadow-md hover:scale-105 hover:bg-purple-300">
                    <img src="uploads/konsultasi-anak.jpg" alt="Konsultasi Anak"
                        class="object-cover w-full h-40 mx-auto mb-4 rounded-lg">
                    <h3 class="mb-2 text-2xl font-bold">Konsultasi Anak</h3>
                    <p class="text-left">Evaluasi menyeluruh oleh tenaga profesional untuk menilai perkembangan anak.
                    </p>
                </div>

                <!-- Terapi Wicara -->
                <div
                    class="p-6 transition transform bg-purple-200 rounded-lg shadow-md hover:scale-105 hover:bg-purple-300">
                    <img src="uploads/terapi-wicara.jpg" alt="Terapi Wicara"
                        class="object-cover w-full h-40 mx-auto mb-4 rounded-lg">
                    <h3 class="mb-2 text-2xl font-bold">Terapi Wicara</h3>
                    <p class="text-left">Menangani gangguan bicara, bahasa, dan suara dengan terapis wicara
                        bersertifikasi.</p>
                </div>

                <!-- Okupasi Terapi -->
                <div
                    class="p-6 transition transform bg-purple-200 rounded-lg shadow-md hover:scale-105 hover:bg-purple-300">
                    <img src="uploads/okupasi.jpg" alt="Okupasi Terapi"
                        class="object-cover w-full h-40 mx-auto mb-4 rounded-lg">
                    <h3 class="mb-2 text-2xl font-bold">Okupasi Terapi</h3>
                    <p class="text-left">Membantu anak mengatasi kesulitan dalam aktivitas sehari-hari.</p>
                </div>

                <!-- Sensori Integrasi -->
                <div
                    class="p-6 transition transform bg-purple-200 rounded-lg shadow-md hover:scale-105 hover:bg-purple-300">
                    <img src="uploads/sensori-integrasi.jpg" alt="Sensori Integrasi"
                        class="object-cover w-full h-40 mx-auto mb-4 rounded-lg">
                    <h3 class="mb-2 text-2xl font-bold">Sensori Integrasi</h3>
                    <p class="text-left">Terapi untuk membantu anak dalam memproses dan merespons rangsangan sensorik.
                    </p>
                </div>

                <!-- Fisioterapi -->
                <div
                    class="p-6 transition transform bg-purple-200 rounded-lg shadow-md hover:scale-105 hover:bg-purple-300">
                    <img src="uploads/fisioterapi-anak.jpg" alt="Fisioterapi"
                        class="object-cover w-full h-40 mx-auto mb-4 rounded-lg">
                    <h3 class="mb-2 text-2xl font-bold">Fisioterapi</h3>
                    <p class="text-left">Mengatasi masalah motorik dan perkembangan anak sesuai kondisi medis.</p>
                </div>

                <!-- Feeding Therapy -->
                <div
                    class="p-6 transition transform bg-purple-200 rounded-lg shadow-md hover:scale-105 hover:bg-purple-300">
                    <img src="uploads/feeding.jpg" alt="Feeding Therapy"
                        class="object-cover w-full h-40 mx-auto mb-4 rounded-lg">
                    <h3 class="mb-2 text-2xl font-bold">Feeding Therapy</h3>
                    <p class="text-left">Terapi untuk anak dengan kesulitan makan dan sensitivitas terhadap makanan.
                    </p>
                </div>
            </div>
        </div>
    </section>


</body>

</html>
