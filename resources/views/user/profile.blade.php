<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Pengembangan Website ANASERA sebagai Pusat Terapi Tumbuh Kembang Anak
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body class="bg-white text-gray-800">
    <!-- Header -->
    <header class="bg-pink-500 text-white">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img alt="ANASERA Logo" class="mr-3" height="50"
                    src="{{ asset('uploads/Logo-ANASERA-1-rev01.jpg') }}" width="50" />
                <h1 class="text-2xl font-bold">
                    ANASERA
                </h1>
            </div>
            <div class="hidden md:flex space-x-6">
                <a class="hover:text-gray-300" href="{{ url('/') }}">Home</a>
                <a class="hover:text-gray-300" href="{{ url('/profile') }}">Profile</a>
                <a class="hover:text-gray-300" href="{{ url('/layanan') }}">Layanan Pasien</a>
                <a class="hover:text-gray-300" href="{{ url('/galery') }}">Gallery</a>
                <a class="hover:text-gray-300" href="{{ url('/konsultasi') }}">Konsultasi</a>
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
            </div>
        </div>
    </header>
    <!-- About Us Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">
                About Us
            </h2>
            <p class="text-lg mb-8">
                GET TO KNOW US
            </p>
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 p-6">
                    <h3 class="text-2xl font-bold mb-4">
                        ANASERA CENTER
                    </h3>
                    <p class="mb-4">
                        Anasera adalah Pusat Terapi Tumbuh Kembang Anak pertama di Ciawi (Child Development), Kabupaten
                        Bogor, yang berdiri sejak 2024. Kami berkomitmen menyediakan layanan terapi terbaik dengan
                        pendekatan menyeluruh
                        untuk mendukung perkembangan optimal anak. Dengan tenaga profesional dan fasilitas yang nyaman,
                        Anasera hadir sebagai tempat yang aman bagi anak-anak dan orang tua dalam menjalani proses
                        terapi.
                    </p>
                </div>
                <div class="md:w-1/2 p-6">
                    <img alt="Happy children and staff" class="rounded-lg" height="300"
                        src="https://storage.googleapis.com/a1aa/image/Z2ucPTR33FZ-40JOYu4w2YVatRqRmhvtC92dB5qG9Sw.jpg"
                        width="500" />
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section -->
    <section class="bg-pink-100 py-12 w-full">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800">
                Our Team
            </h1>
            <p class="mt-4 text-gray-700">
                Tim kami di Anasera berkomitmen untuk memberikan perawatan dan dukungan terbaik, memastikan pengalaman
                terapi yang optimal untuk tumbuh kembang setiap anak.
            </p>
        </div>
        <div class="mt-12 flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-12">
            <div class="text-center">
                <img alt="Portrait of Pasya Talitha, Co-Founder & Co-CEO" class="w-48 h-48 rounded-full mx-auto"
                    height="200" src="{{ asset('uploads/pasya.jpg') }}" width="200" />
                <h2 class="mt-4 text-xl font-bold text-gray-800">
                    PASYA TALITHA ULA SABILLA,S.Tr.Kes
                </h2>
                <p class="text-gray-600">
                    CO-FOUNDER & CO-CEO
                </p>
            </div>
            <div class="text-center">
                <img alt="Portrait of Azza Talitha, Co-Founder & Co-CEO" class="w-48 h-48 rounded-full mx-auto"
                    height="200" src="{{ asset('uploads/azza.jpg') }}" width="200" />
                <h2 class="mt-4 text-xl font-bold text-gray-800">
                    AZZA TALITHA TSANIA MAESYABANI,A. Md. Kes
                </h2>
                <p class="text-gray-600">
                    CO-FOUNDER & CO-CEO
                </p>
            </div>
        </div>
    </section>
    <!-- Our Services Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 bg-blue-200 rounded-lg shadow-md transition transform hover:bg-blue-300 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up">
                    <h3 class="text-2xl font-bold mb-2">Konsultasi Tumbuh Kembang Anak</h3>
                </div>
                <div class="p-6 bg-blue-200 rounded-lg shadow-md transition transform hover:bg-blue-300 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-2xl font-bold mb-2">Terapi Wicara</h3>
                </div>
                <div class="p-6 bg-blue-200 rounded-lg shadow-md transition transform hover:bg-blue-300 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-bold mb-2">Okupasi Terapi</h3>
                </div>
                <div class="p-6 bg-blue-200 rounded-lg shadow-md transition transform hover:bg-blue-300 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-2xl font-bold mb-2">Sensori Integrasi</h3>
                </div>
                <div class="p-6 bg-blue-200 rounded-lg shadow-md transition transform hover:bg-blue-300 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-2xl font-bold mb-2">Fisioterapi</h3>
                </div>
                <div class="p-6 bg-blue-200 rounded-lg shadow-md transition transform hover:bg-blue-300 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="500">
                    <h3 class="text-2xl font-bold mb-2">Feeding Therapy</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Facilities Section -->
    <section class="py-16 bg-pink-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Our Facilities</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up">
                    <h3 class="text-2xl font-bold mb-2 text-white">Resepsionis</h3>
                </div>
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-2xl font-bold mb-2 text-white">Ruang Tunggu</h3>
                </div>
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-bold mb-2 text-white">Tempat Bermain Anak</h3>
                </div>
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-2xl font-bold mb-2 text-white">Ruang Konsultasi</h3>
                </div>
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-2xl font-bold mb-2 text-white">Ruang Terapi Wicara</h3>
                </div>
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="500">
                    <h3 class="text-2xl font-bold mb-2 text-white">Ruang Sensori Integrasi</h3>
                </div>
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="600">
                    <h3 class="text-2xl font-bold mb-2 text-white">Ruang Okupasi Terapi</h3>
                </div>
                <div class="p-6 bg-pink-500 rounded-lg shadow-md transition transform hover:bg-pink-600 hover:scale-105 hover:shadow-lg cursor-pointer"
                    data-aos="fade-up" data-aos-delay="700">
                    <h3 class="text-2xl font-bold mb-2 text-white">Ruang Fisioterapi</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Location Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Our Location</h2>
            <p class="text-lg mb-8">FIND US HERE</p>
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 p-6">
                    <h3 class="text-2xl font-bold mb-4">ANASERA CENTER LOCATION</h3>
                    <p class="mb-4">
                        📍RUKO GRAHA CIAWI NO. 12 Jl. Raya Tapos, Kp. Parung Jambu, Banjar Waru, Kec. Ciawi, Kabupaten
                        Bogor, dengan akses yang mudah dijangkau. Lokasi kami
                        dirancang untuk memberikan kenyamanan dan keamanan bagi anak-anak dan orang tua selama proses
                        terapi.
                    </p>
                </div>
                <div class="md:w-1/2 p-6">
                    <!-- Gantilah gambar dengan peta -->
                    <div id="map" class="rounded-lg" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tambahkan Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init();

        // Inisialisasi Peta
        var map = L.map('map').setView([-6.690892, 106.951540], 15); // Koordinat Ciawi, Bogor

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([-6.690892, 106.951540]).addTo(map)
            .bindPopup("<b>ANASERA Center</b><br>Ciawi, Kabupaten Bogor")
            .openPopup();
    </script>

</body>

</html>
