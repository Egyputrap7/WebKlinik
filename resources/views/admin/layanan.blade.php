<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Dashboard Notifikasi - ANASERA Admin
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 110%;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
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

                <form action="{{ route('admin.logout') }}" method="POST"
                    onsubmit="return confirm('Yakin ingin logout?')">
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
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="hover:text-gray-300">
                Logout
            </a>

            <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

        </nav>
    </header>

    <!-- Konten Dashboard Notifikasi -->
    <main class="container mx-auto mt-8 px-6 flex-grow">
        <h2 class="text-3xl font-semibold mb-6">
            Dashboard Notifikasi
        </h2>
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Kuota Hampir Penuh -->
            <div class="bg-red-100 border border-red-300 rounded p-6 flex flex-col items-center text-center space-y-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-5xl">
                </i>
                <h3 class="font-semibold text-red-700 text-xl">
                    Kuota Hampir Penuh
                </h3>
                <p class="text-red-800 max-w-xs">
                    Layanan
                    <strong>
                        Konsultasi Anak
                    </strong>
                    hampir mencapai batas kuota
                    hari ini.
                </p>
                <button class="mt-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition"
                    id="btnViewDetailsQuota">
                    Lihat Detail
                </button>
            </div>
            <!-- Statistik Harian -->
            <div
                class="bg-blue-100 border border-blue-300 rounded p-6 flex flex-col items-center text-center space-y-4">
                <i class="fas fa-chart-line text-blue-600 text-5xl">
                </i>
                <h3 class="font-semibold text-blue-700 text-xl">
                    Statistik Harian
                </h3>
                <p class="text-blue-800 max-w-xs">
                    Layanan
                    <strong>
                        Terapi Wicara
                    </strong>
                    paling banyak dipesan minggu ini.
                </p>
                <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                    id="btnViewDetailsStats">
                    Lihat Statistik
                </button>
            </div>
            <!-- Keamanan & Hak Akses -->
            <div
                class="bg-green-100 border border-green-300 rounded p-6 flex flex-col items-center text-center space-y-4">
                <i class="fas fa-users-cog text-green-600 text-5xl">
                </i>
                <h3 class="font-semibold text-green-700 text-xl">
                    Keamanan &amp; Hak Akses
                </h3>
                <p class="text-green-800 max-w-xs">
                    Akses fitur edit dan jadwal dibatasi sesuai peran admin (admin utama,
                    editor, dll).
                </p>
                <button class="mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition"
                    id="btnViewDetailsSecurity">
                    Lihat Pengaturan
                </button>
            </div>
        </section>
        @php
            use Carbon\Carbon;

            $timezone = 'Asia/Jakarta';
            $today = Carbon::now($timezone)->startOfDay();
            $datesForWeek = [];
            $datesMap = collect($dates)->keyBy('tanggal');

            for ($i = 0; $i < 7; $i++) {
                $currentDate = $today->copy()->addDays($i)->toDateString();

                if ($datesMap->has($currentDate)) {
                    $datesForWeek[] = $datesMap[$currentDate];
                } else {
                    $datesForWeek[] = [
                        'tanggal' => $currentDate,
                        'available' => null,
                        'status' => 'Tersedia',
                    ];
                }
            }
        @endphp



        <!-- Manajemen Jadwal Operasional -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">
                Manajemen Jadwal Operasional
            </h2>
            <div class="bg-white rounded shadow p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-pink-600 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Tanggal
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Status
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Jam Operasional
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Reservasi
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Kuota
                                </th>
                                <th class="px-4 py-2 text-center text-sm font-semibold uppercase">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="scheduleTableBody">
                            @foreach ($dates as $date)
                                @php
                                    $carbonDate = Carbon::parse($date['date'])->locale('id');

                                @endphp
                                <tr>
                                    <td class="px-4 py-2 text-sm">
                                        {{ $carbonDate->translatedFormat('l, d/m/Y') }}
                                    </td>
                                    <td class="text-sm">
                                        {{ $date['quota_label'] }}
                                        @if ($date['is_full'])
                                            <span class="text-red-600 font-bold">(Penuh)</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-sm">
                                        {{ $date['status'] === 'Tersedia' ? '08:00 - 16:00' : '-' }}
                                    </td>
                                    <td class="px-4 py-2 text-sm">
                                        {{ $date['status'] }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <button
                                            class="editScheduleBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm"
                                            data-date="{{ $date['date'] }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>





                    </table>
                </div>
            </div>
        </section>
        <!-- Modal Edit Jadwal -->
        <div aria-labelledby="modalEditScheduleTitle" aria-modal="true"
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
            id="modalEditSchedule" role="dialog">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4 p-6 relative">
                <h3 class="text-xl font-semibold mb-4" id="modalEditScheduleTitle">
                    Edit Jadwal Operasional
                </h3>
                <form class="space-y-4" id="editScheduleForm" method="POST">
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="editDate">
                            Tanggal
                        </label>
                        <input
                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-pink-600 focus:border-pink-600"
                            id="editDate" name="editDate" readonly="" type="date" disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="editStatus">
                            Status
                        </label>
                        <select
                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-pink-600 focus:border-pink-600"
                            id="editStatus" name="editStatus">
                            <option value="Buka">
                                Buka
                            </option>
                            <option value="Libur Nasional">
                                Libur Nasional
                            </option>
                            <option value="Tutup">
                                Tutup
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="editHours">
                            Jam Operasional
                        </label>
                        <input
                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-pink-600 focus:border-pink-600"
                            id="editHours" name="editHours" placeholder="Contoh: 08:00 - 16:00" type="text"
                            disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="editReservation">
                            Status Reservasi
                        </label>
                        <select
                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-pink-600 focus:border-pink-600"
                            id="editReservation" name="editReservation">
                            <option value="Tersedia">
                                Tersedia
                            </option>
                            <option value="Full Booked">
                                Full Booked
                            </option>
                            <option value="Tutup">
                                Tutup
                            </option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition"
                            id="cancelEditSchedule" type="button">
                            Batal
                        </button>
                        <button class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition"
                            type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Manajemen Konten Layanan -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">
                Manajemen Konten Layanan
            </h2>
            <div class="bg-white rounded shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <input
                        class="border border-gray-300 rounded px-3 py-2 w-64 focus:outline-none focus:ring-pink-600 focus:border-pink-600"
                        id="searchService" placeholder="Cari layanan..." type="text" />
                    <button class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition"
                        id="btnAddService">
                        Tambah Layanan
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="servicesTable">
                        <thead class="bg-pink-600 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Urutan
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Gambar
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Judul
                                </th>
                                <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                                    Deskripsi
                                </th>
                                <th class="px-4 py-2 text-center text-sm font-semibold uppercase">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="servicesTableBody">
                            <tr class="service-row cursor-move" data-id="1" draggable="true">
                                <td class="px-4 py-2 text-sm text-center font-semibold">
                                    1
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <img alt="Gambar layanan Terapi Wicara, a child speech therapy session with a therapist and child interacting"
                                        class="w-20 h-15 object-cover rounded" height="60"
                                        src="https://storage.googleapis.com/a1aa/image/fa2059e9-961f-4f0e-0ce8-c3f307b6f1d2.jpg"
                                        width="80" />
                                </td>
                                <td class="px-4 py-2 text-sm font-semibold">
                                    Terapi Wicara
                                </td>
                                <td class="px-4 py-2 text-sm max-w-xs truncate">
                                    Layanan terapi untuk membantu anak dalam perkembangan bicara dan bahasa.
                                </td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <button
                                        class="editServiceBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm"
                                        data-id="1">
                                        Edit
                                    </button>
                                    <button
                                        class="deleteServiceBtn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                                        data-id="1">
                                        <i class="fas fa-trash-alt">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="service-row cursor-move" data-id="2" draggable="true">
                                <td class="px-4 py-2 text-sm text-center font-semibold">
                                    2
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <img alt="Gambar layanan Konsultasi Anak, a pediatric consultation with a doctor and child patient"
                                        class="w-20 h-15 object-cover rounded" height="60"
                                        src="https://storage.googleapis.com/a1aa/image/f6a9b4a5-2e23-438f-e5a9-7d4f2ccbc7f1.jpg"
                                        width="80" />
                                </td>
                                <td class="px-4 py-2 text-sm font-semibold">
                                    Konsultasi Anak
                                </td>
                                <td class="px-4 py-2 text-sm max-w-xs truncate">
                                    Konsultasi kesehatan dan perkembangan anak dengan tenaga ahli profesional.
                                </td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <button
                                        class="editServiceBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm"
                                        data-id="2">
                                        Edit
                                    </button>
                                    <button
                                        class="deleteServiceBtn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                                        data-id="2">
                                        <i class="fas fa-trash-alt">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="service-row cursor-move" data-id="3" draggable="true">
                                <td class="px-4 py-2 text-sm text-center font-semibold">
                                    3
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <img alt="Gambar layanan Fisioterapi, a physiotherapy session with patient exercising with therapist assistance"
                                        class="w-20 h-15 object-cover rounded" height="60"
                                        src="https://storage.googleapis.com/a1aa/image/7c46ec1b-0ece-41fc-58a6-ab0a6be2e52c.jpg"
                                        width="80" />
                                </td>
                                <td class="px-4 py-2 text-sm font-semibold">
                                    Fisioterapi
                                </td>
                                <td class="px-4 py-2 text-sm max-w-xs truncate">
                                    Terapi fisik untuk membantu pemulihan dan peningkatan fungsi tubuh.
                                </td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <button
                                        class="editServiceBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm"
                                        data-id="3">
                                        Edit
                                    </button>
                                    <button
                                        class="deleteServiceBtn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                                        data-id="3">
                                        <i class="fas fa-trash-alt">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="service-row cursor-move" data-id="4" draggable="true">
                                <td class="px-4 py-2 text-sm text-center font-semibold">
                                    4
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <img alt="Gambar layanan Terapi Okupasi, a child doing occupational therapy activities with therapist"
                                        class="w-20 h-15 object-cover rounded" height="60"
                                        src="https://storage.googleapis.com/a1aa/image/34cbbd5a-ab72-4ca2-8e27-e1b56276f891.jpg"
                                        width="80" />
                                </td>
                                <td class="px-4 py-2 text-sm font-semibold">
                                    Terapi Okupasi
                                </td>
                                <td class="px-4 py-2 text-sm max-w-xs truncate">
                                    Terapi untuk membantu anak mengembangkan keterampilan motorik dan kemandirian.
                                </td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <button
                                        class="editServiceBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm"
                                        data-id="4">
                                        Edit
                                    </button>
                                    <button
                                        class="deleteServiceBtn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                                        data-id="4">
                                        <i class="fas fa-trash-alt">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="service-row cursor-move" data-id="5" draggable="true">
                                <td class="px-4 py-2 text-sm text-center font-semibold">
                                    5
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <img alt="Gambar layanan Psikologi, a psychologist counseling a child and parent"
                                        class="w-20 h-15 object-cover rounded" height="60"
                                        src="https://storage.googleapis.com/a1aa/image/153ce9de-b139-4914-aea1-35b639a414d4.jpg"
                                        width="80" />
                                </td>
                                <td class="px-4 py-2 text-sm font-semibold">
                                    Psikologi
                                </td>
                                <td class="px-4 py-2 text-sm max-w-xs truncate">
                                    Layanan konsultasi psikologi untuk anak dan keluarga.
                                </td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <button
                                        class="editServiceBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm"
                                        data-id="5">
                                        Edit
                                    </button>
                                    <button
                                        class="deleteServiceBtn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                                        data-id="5">
                                        <i class="fas fa-trash-alt">
                                        </i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Modal Tambah/Edit Layanan -->
        <div aria-labelledby="modalServiceFormTitle" aria-modal="true"
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" id="modalServiceForm"
            role="dialog">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4 p-6 relative overflow-y-auto max-h-[90vh]">
                <h3 class="text-xl font-semibold mb-4" id="modalServiceFormTitle">
                    Tambah/Edit Layanan
                </h3>
                <form class="space-y-4" enctype="multipart/form-data" id="serviceForm">
                    <input id="serviceId" name="serviceId" type="hidden" />
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="serviceTitle">
                            Judul Layanan
                        </label>
                        <input
                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-pink-600 focus:border-pink-600"
                            id="serviceTitle" name="serviceTitle" required="" type="text" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="serviceDescription">
                            Deskripsi
                        </label>
                        <textarea
                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-pink-600 focus:border-pink-600"
                            id="serviceDescription" name="serviceDescription" required="" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="serviceImage">
                            Gambar Layanan
                        </label>
                        <input accept="image/*" class="mt-1 block w-full" id="serviceImage" name="serviceImage"
                            type="file" />
                        <p class="text-xs text-gray-500 mt-1">
                            Maksimal ukuran 2MB. Format: JPG, PNG.
                        </p>
                        <img alt="Preview gambar layanan" class="mt-2 max-w-xs rounded hidden"
                            id="serviceImagePreview" src="" />
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition"
                            id="cancelServiceForm" type="button">
                            Batal
                        </button>
                        <button class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition"
                            type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!-- Modal Kuota Hampir Penuh -->
    <div aria-labelledby="modalQuotaTitle" aria-modal="true"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" id="modalQuota"
        role="dialog">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4 p-6 relative">
            <h3 class="text-xl font-semibold mb-4" id="modalQuotaTitle">
                Detail Kuota Hampir Penuh
            </h3>
            <p>
                Berikut adalah layanan yang hampir mencapai kuota maksimal hari ini.
            </p>
            <table class="min-w-full divide-y divide-gray-200 mt-4">
                <thead class="bg-pink-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                            Layanan
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                            Kuota Maksimal
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                            Kuota Terpakai
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                            Sisa Kuota
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 text-sm">
                            Konsultasi Anak
                        </td>
                        <td class="px-4 py-2 text-sm">
                            50
                        </td>
                        <td class="px-4 py-2 text-sm">
                            47
                        </td>
                        <td class="px-4 py-2 text-sm text-red-600 font-semibold">
                            3
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 text-sm">
                            Terapi Wicara
                        </td>
                        <td class="px-4 py-2 text-sm">
                            40
                        </td>
                        <td class="px-4 py-2 text-sm">
                            38
                        </td>
                        <td class="px-4 py-2 text-sm text-red-600 font-semibold">
                            2
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="mt-6 bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition"
                id="closeModalQuota">
                Tutup
            </button>
        </div>
    </div>
    <!-- Modal Statistik Harian -->
    <div aria-labelledby="modalStatsTitle" aria-modal="true"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" id="modalStats"
        role="dialog">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4 p-6 relative">
            <h3 class="text-xl font-semibold mb-4" id="modalStatsTitle">
                Statistik Harian Layanan
            </h3>
            <p>
                Statistik layanan yang paling banyak dipesan selama minggu ini.
            </p>
            <table class="min-w-full divide-y divide-gray-200 mt-4">
                <thead class="bg-pink-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                            Layanan
                        </th>
                        <th class="px-4 py-2 text-left text-sm font-semibold uppercase">
                            Jumlah Pesanan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 text-sm">
                            Terapi Wicara
                        </td>
                        <td class="px-4 py-2 text-sm font-semibold">
                            120
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 text-sm">
                            Konsultasi Anak
                        </td>
                        <td class="px-4 py-2 text-sm font-semibold">
                            95
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 text-sm">
                            Fisioterapi
                        </td>
                        <td class="px-4 py-2 text-sm font-semibold">
                            80
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="mt-6 bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition"
                id="closeModalStats">
                Tutup
            </button>
        </div>
    </div>
    <!-- Modal Keamanan & Hak Akses -->
    <div aria-labelledby="modalSecurityTitle" aria-modal="true"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" id="modalSecurity"
        role="dialog">
        <div class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4 p-6 relative">
            <h3 class="text-xl font-semibold mb-4" id="modalSecurityTitle">
                Pengaturan Keamanan &amp; Hak Akses
            </h3>
            <p>
                Sistem admin panel dilengkapi dengan autentikasi yang kuat dan
                pengaturan hak akses berbasis peran:
            </p>
            <ul class="list-disc list-inside mt-4 space-y-2 text-gray-700">
                <li>
                    <strong>
                        Admin Utama:
                    </strong>
                    Akses penuh ke semua fitur termasuk
                    manajemen layanan, jadwal, dan pengaturan pengguna.
                </li>
                <li>
                    <strong>
                        Editor:
                    </strong>
                    Bisa menambah dan mengedit layanan serta
                    jadwal, tapi tidak bisa menghapus atau mengubah pengaturan pengguna.
                </li>
                <li>
                    <strong>
                        Viewer:
                    </strong>
                    Hanya bisa melihat data tanpa akses edit.
                </li>
            </ul>
            <p class="mt-4">
                Semua aktivitas tercatat dalam log audit untuk keamanan dan
                transparansi.
            </p>
            <button class="mt-6 bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700 transition"
                id="closeModalSecurity">
                Tutup
            </button>
        </div>
    </div>
    <script>
        // Modal elements
        const modalQuota = document.getElementById("modalQuota");
        const modalStats = document.getElementById("modalStats");
        const modalSecurity = document.getElementById("modalSecurity");
        const modalEditSchedule = document.getElementById("modalEditSchedule");
        const modalServiceForm = document.getElementById("modalServiceForm");

        // Buttons
        const btnViewDetailsQuota = document.getElementById("btnViewDetailsQuota");
        const btnViewDetailsStats = document.getElementById("btnViewDetailsStats");
        const btnViewDetailsSecurity = document.getElementById("btnViewDetailsSecurity");

        const closeModalQuota = document.getElementById("closeModalQuota");
        const closeModalStats = document.getElementById("closeModalStats");
        const closeModalSecurity = document.getElementById("closeModalSecurity");

        // Open modals
        btnViewDetailsQuota.addEventListener("click", () => {
            modalQuota.classList.remove("hidden");
            modalQuota.classList.add("flex");
        });
        btnViewDetailsStats.addEventListener("click", () => {
            modalStats.classList.remove("hidden");
            modalStats.classList.add("flex");
        });
        btnViewDetailsSecurity.addEventListener("click", () => {
            modalSecurity.classList.remove("hidden");
            modalSecurity.classList.add("flex");
        });

        // Close modals
        closeModalQuota.addEventListener("click", () => {
            modalQuota.classList.add("hidden");
            modalQuota.classList.remove("flex");
        });
        closeModalStats.addEventListener("click", () => {
            modalStats.classList.add("hidden");
            modalStats.classList.remove("flex");
        });
        closeModalSecurity.addEventListener("click", () => {
            modalSecurity.classList.add("hidden");
            modalSecurity.classList.remove("flex");
        });

        // Close modals on clicking outside modal content
        [modalQuota, modalStats, modalSecurity, modalEditSchedule, modalServiceForm].forEach((modal) => {
            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }
            });
        });

        // Manajemen Jadwal Operasional - Edit Modal Logic
        const editScheduleForm = document.getElementById("editScheduleForm");
        const cancelEditSchedule = document.getElementById("cancelEditSchedule");
        const scheduleTableBody = document.getElementById("scheduleTableBody");

        // Store schedule data in JS object for demo purposes
        const scheduleData = @json($dates);

        function refreshScheduleTable() {
            const scheduleTableBody = document.getElementById("scheduleTableBody");
            scheduleTableBody.innerHTML = "";
            scheduleData.forEach((item) => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                <td class="px-4 py-2 text-sm">${item.date} (${item.day})</td>
                <td class="px-4 py-2 text-sm">${item.status}</td>
                <td class="px-4 py-2 text-sm">${item.hours}</td>
                <td class="px-4 py-2 text-sm">${item.is_full ? 'Full Booked' : item.reservation}</td>
                <td class="px-4 py-2 text-sm">${item.quota_label}${item.is_full ? ' <span class="text-red-500">(Penuh)</span>' : ''}</td>

                <td class="px-4 py-2 text-center">
                    <button class="editScheduleBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm" data-date="${item.date}">Edit</button>
                </td>
            `;
                scheduleTableBody.appendChild(tr);
            });
            attachEditScheduleListeners();
        }

        function attachEditScheduleListeners() {
            const editButtons = document.querySelectorAll(".editScheduleBtn");
            editButtons.forEach((btn) => {
                btn.addEventListener("click", () => {
                    const date = btn.getAttribute("data-date");
                    const schedule = scheduleData.find((s) => s.date === date);
                    if (schedule) {
                        document.getElementById("editDate").value = schedule.date;
                        document.getElementById("editStatus").value = schedule.status;
                        document.getElementById("editStatus").addEventListener("change", function() {
                            const status = this.value;
                            const hoursInput = document.getElementById("editHours");

                            if (status === "Buka") {
                                hoursInput.value = "08:00 - 16:00";
                            } else {
                                hoursInput.value = "-"; // Kosongkan jika status bukan "Buka"
                            }
                        });
                        document.getElementById("editReservation").value = schedule.reservation;
                        modalEditSchedule.classList.remove("hidden");
                        modalEditSchedule.classList.add("flex");
                    }
                });
            });
        }

        cancelEditSchedule.addEventListener("click", () => {
            modalEditSchedule.classList.add("hidden");
            modalEditSchedule.classList.remove("flex");
        });

        editScheduleForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const date = document.getElementById("editDate").value;
            const status = document.getElementById("editStatus").value;
            let hours = document.getElementById("editHours").value.trim();
            const reservation = document.getElementById("editReservation").value;

            if (status !== "Buka") {
                hours = "-";
            } else if (!hours) {
                alert("Jam operasional harus diisi jika status buka.");
                return;
            }

            // Kirim ke database
            fetch("/admin/jadwal-update", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        date,
                        status,
                        hours,
                        reservation
                    }),
                })
                .then((res) => {
                    if (!res.ok) throw new Error("Gagal simpan ke database.");
                    // Update data lokal untuk tampilan
                    const index = scheduleData.findIndex((s) => s.date === date);
                    if (index !== -1) {
                        scheduleData[index].status = status;
                        scheduleData[index].hours = hours;
                        scheduleData[index].reservation = reservation;
                    }
                    refreshScheduleTable();
                    modalEditSchedule.classList.add("hidden");
                    modalEditSchedule.classList.remove("flex");
                })
                .catch((err) => {
                    console.error(err);
                    alert("Gagal menyimpan perubahan.");
                });
        });


        refreshScheduleTable();

        // Manajemen Konten Layanan - Data & Logic
        const servicesTableBody = document.getElementById("servicesTableBody");
        const btnAddService = document.getElementById("btnAddService");
        const modalServiceFormTitle = document.getElementById("modalServiceFormTitle");
        const serviceForm = document.getElementById("serviceForm");
        const cancelServiceForm = document.getElementById("cancelServiceForm");
        const serviceIdInput = document.getElementById("serviceId");
        const serviceTitleInput = document.getElementById("serviceTitle");
        const serviceDescriptionInput = document.getElementById("serviceDescription");
        const serviceImageInput = document.getElementById("serviceImage");
        const serviceImagePreview = document.getElementById("serviceImagePreview");
        const searchServiceInput = document.getElementById("searchService");

        // Initial services data
        let servicesData = [{
                id: 1,
                order: 1,
                title: "Terapi Wicara",
                description: "Layanan terapi untuk membantu anak dalam perkembangan bicara dan bahasa.",
                image: "https://placehold.co/80x60/png?text=Terapi+Wicara",
                imageAlt: "Gambar layanan Terapi Wicara, a child speech therapy session with a therapist and child interacting"
            },
            {
                id: 2,
                order: 2,
                title: "Konsultasi Anak",
                description: "Konsultasi kesehatan dan perkembangan anak dengan tenaga ahli profesional.",
                image: "https://placehold.co/80x60/png?text=Konsultasi+Anak",
                imageAlt: "Gambar layanan Konsultasi Anak, a pediatric consultation with a doctor and child patient"
            },
            {
                id: 3,
                order: 3,
                title: "Fisioterapi",
                description: "Terapi fisik untuk membantu pemulihan dan peningkatan fungsi tubuh.",
                image: "https://placehold.co/80x60/png?text=Fisioterapi",
                imageAlt: "Gambar layanan Fisioterapi, a physiotherapy session with patient exercising with therapist assistance"
            },
            {
                id: 4,
                order: 4,
                title: "Terapi Okupasi",
                description: "Terapi untuk membantu anak mengembangkan keterampilan motorik dan kemandirian.",
                image: "https://placehold.co/80x60/png?text=Terapi+Okupasi",
                imageAlt: "Gambar layanan Terapi Okupasi, a child doing occupational therapy activities with therapist"
            },
            {
                id: 5,
                order: 5,
                title: "Psikologi",
                description: "Layanan konsultasi psikologi untuk anak dan keluarga.",
                image: "https://placehold.co/80x60/png?text=Psikologi",
                imageAlt: "Gambar layanan Psikologi, a psychologist counseling a child and parent"
            }
        ];

        function renderServicesTable(filter = "") {
            servicesTableBody.innerHTML = "";
            let filteredServices = servicesData;
            if (filter.trim() !== "") {
                const lowerFilter = filter.toLowerCase();
                filteredServices = servicesData.filter(s => s.title.toLowerCase().includes(lowerFilter) || s.description
                    .toLowerCase().includes(lowerFilter));
            }
            filteredServices.sort((a, b) => a.order - b.order).forEach((service, index) => {
                const tr = document.createElement("tr");
                tr.setAttribute("draggable", "true");
                tr.classList.add("service-row", "cursor-move");
                tr.dataset.id = service.id;
                tr.innerHTML = `
          <td class="px-4 py-2 text-sm text-center font-semibold">${service.order}</td>
          <td class="px-4 py-2 text-sm">
            <img src="${service.image}" alt="${service.imageAlt}" class="w-20 h-15 object-cover rounded" />
          </td>
          <td class="px-4 py-2 text-sm font-semibold">${service.title}</td>
          <td class="px-4 py-2 text-sm max-w-xs truncate">${service.description}</td>
          <td class="px-4 py-2 text-center space-x-2">
            <button class="editServiceBtn bg-pink-600 text-white px-3 py-1 rounded hover:bg-pink-700 transition text-sm" data-id="${service.id}">Edit</button>
            <button class="deleteServiceBtn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm" data-id="${service.id}"><i class="fas fa-trash-alt"></i></button>
          </td>
        `;
                servicesTableBody.appendChild(tr);
            });
            attachServiceButtonsListeners();
            attachDragAndDrop();
        }

        function attachServiceButtonsListeners() {
            const editButtons = document.querySelectorAll(".editServiceBtn");
            editButtons.forEach(btn => {
                btn.onclick = () => {
                    const id = parseInt(btn.dataset.id);
                    openEditServiceModal(id);
                };
            });
            const deleteButtons = document.querySelectorAll(".deleteServiceBtn");
            deleteButtons.forEach(btn => {
                btn.onclick = () => {
                    const id = parseInt(btn.dataset.id);
                    if (confirm("Apakah Anda yakin ingin menghapus layanan ini?")) {
                        servicesData = servicesData.filter(s => s.id !== id);
                        // Reorder after deletion
                        servicesData.forEach((s, i) => s.order = i + 1);
                        renderServicesTable(searchServiceInput.value);
                    }
                };
            });
        }

        btnAddService.addEventListener("click", () => {
            openAddServiceModal();
        });

        cancelServiceForm.addEventListener("click", () => {
            closeServiceModal();
        });

        serviceImageInput.addEventListener("change", () => {
            const file = serviceImageInput.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert("Ukuran gambar maksimal 2MB.");
                    serviceImageInput.value = "";
                    serviceImagePreview.src = "";
                    serviceImagePreview.classList.add("hidden");
                    return;
                }
                const reader = new FileReader();
                reader.onload = (e) => {
                    serviceImagePreview.src = e.target.result;
                    serviceImagePreview.classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            } else {
                serviceImagePreview.src = "";
                serviceImagePreview.classList.add("hidden");
            }
        });

        serviceForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const id = serviceIdInput.value ? parseInt(serviceIdInput.value) : null;
            const title = serviceTitleInput.value.trim();
            const description = serviceDescriptionInput.value.trim();

            if (!title || !description) {
                alert("Judul dan deskripsi harus diisi.");
                return;
            }

            // Handle image
            let imageSrc = "";
            let imageAlt = "";
            if (serviceImageInput.files.length > 0) {
                // Use preview src as image src (simulate upload)
                imageSrc = serviceImagePreview.src;
                imageAlt = `Gambar layanan ${title}`;
            }

            if (id) {
                // Edit existing
                const service = servicesData.find(s => s.id === id);
                if (service) {
                    service.title = title;
                    service.description = description;
                    if (imageSrc) {
                        service.image = imageSrc;
                        service.imageAlt = imageAlt;
                    }
                }
            } else {
                // Add new
                const newId = servicesData.length ? Math.max(...servicesData.map(s => s.id)) + 1 : 1;
                const newOrder = servicesData.length + 1;
                servicesData.push({
                    id: newId,
                    order: newOrder,
                    title,
                    description,
                    image: imageSrc || "https://placehold.co/80x60/png?text=No+Image",
                    imageAlt: imageAlt || `Gambar layanan ${title}`
                });
            }
            renderServicesTable(searchServiceInput.value);
            closeServiceModal();
        });

        function openAddServiceModal() {
            modalServiceForm.classList.remove("hidden");
            modalServiceForm.classList.add("flex");
            modalServiceFormTitle.textContent = "Tambah Layanan";
            serviceIdInput.value = "";
            serviceTitleInput.value = "";
            serviceDescriptionInput.value = "";
            serviceImageInput.value = "";
            serviceImagePreview.src = "";
            serviceImagePreview.classList.add("hidden");
        }

        function openEditServiceModal(id) {
            const service = servicesData.find(s => s.id === id);
            if (!service) return;
            modalServiceForm.classList.remove("hidden");
            modalServiceForm.classList.add("flex");
            modalServiceFormTitle.textContent = "Edit Layanan";
            serviceIdInput.value = service.id;
            serviceTitleInput.value = service.title;
            serviceDescriptionInput.value = service.description;
            serviceImagePreview.src = service.image;
            serviceImagePreview.alt = service.imageAlt;
            serviceImagePreview.classList.remove("hidden");
            serviceImageInput.value = "";
        }

        function closeServiceModal() {
            modalServiceForm.classList.add("hidden");
            modalServiceForm.classList.remove("flex");
        }

        searchServiceInput.addEventListener("input", () => {
            renderServicesTable(searchServiceInput.value);
        });

        // Drag and Drop for service rows to reorder
        let dragSrcEl = null;

        function handleDragStart(e) {
            dragSrcEl = this;
            e.dataTransfer.effectAllowed = "move";
            e.dataTransfer.setData("text/html", this.outerHTML);
            this.classList.add("opacity-50");
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.dataTransfer.dropEffect = "move";
            return false;
        }

        function handleDragEnter() {
            this.classList.add("bg-pink-100");
        }

        function handleDragLeave() {
            this.classList.remove("bg-pink-100");
        }

        function handleDrop(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            }
            if (dragSrcEl !== this) {
                // Swap the dragged and dropped rows in the DOM
                const draggedId = parseInt(dragSrcEl.dataset.id);
                const droppedId = parseInt(this.dataset.id);

                const draggedIndex = servicesData.findIndex(s => s.id === draggedId);
                const droppedIndex = servicesData.findIndex(s => s.id === droppedId);

                // Swap order
                const tempOrder = servicesData[draggedIndex].order;
                servicesData[draggedIndex].order = servicesData[droppedIndex].order;
                servicesData[droppedIndex].order = tempOrder;

                // Sort by order
                servicesData.sort((a, b) => a.order - b.order);

                renderServicesTable(searchServiceInput.value);
            }
            return false;
        }

        function handleDragEnd() {
            this.classList.remove("opacity-50");
            const rows = document.querySelectorAll(".service-row");
            rows.forEach(row => row.classList.remove("bg-pink-100"));
        }

        function attachDragAndDrop() {
            const rows = document.querySelectorAll(".service-row");
            rows.forEach(row => {
                row.addEventListener("dragstart", handleDragStart, false);
                row.addEventListener("dragenter", handleDragEnter, false);
                row.addEventListener("dragover", handleDragOver, false);
                row.addEventListener("dragleave", handleDragLeave, false);
                row.addEventListener("drop", handleDrop, false);
                row.addEventListener("dragend", handleDragEnd, false);
            });
        }

        renderServicesTable();
    </script>
</body>

</html>
