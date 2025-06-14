<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Reservasi Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .icon-beat {
            animation: beat 1.5s infinite;
        }

        @keyframes beat {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.15);
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-5xl w-full bg-white shadow-lg rounded-xl p-6 sm:p-14 mx-auto">
        <div class="mb-6 ml-1">
            <a href="{{ url('/layanan') }}"
                class="inline-flex items-center text-purple-500 hover:text-purple-700 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <h1 class="text-3xl font-semibold text-purple-400 text-center mb-8">
            Form Reservasi Pasien - Tanggal 01 Jan 2024
        </h1>

        <div class="flex justify-center mb-8">
            <div
                class="w-24 h-24 rounded-full flex items-center justify-center bg-pink-100 border-4 border-purple-200 shadow-lg">
                <i class="fas fa-child text-6xl icon-beat" aria-hidden="true"></i>
                <span class="sr-only">Icon anak-anak</span>
            </div>
        </div>

        <form method="POST" action="{{ url('/user/reservasi') }}">
            @csrf
            <input type="hidden" name="jadwal_reservasi" value="{{ $tanggal }}" />
            <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0">
                <div class="flex-1">
                    <label for="nama_pasien" class="block mb-2 text-purple-400 font-semibold">
                        Nama Pasien <span>*</span>
                    </label>
                    <input type="text" placeholder="Masukkan nama pasien" name="nama_pasien" id="nama_pasien"
                        required
                        class="w-full rounded-lg border border-purple-200 px-4 py-2 placeholder-purple-300 focus:border-purple-400 focus:ring-1 focus:ring-purple-400" />
                </div>

                <div class="flex-1">
                    <label for="umur" class="block mb-2 text-purple-400 font-semibold">
                        Umur <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="umur" placeholder="Umur" id="umur" required min="0"
                        class="w-full rounded-lg border border-purple-200 px-4 py-2 placeholder-purple-300 focus:border-purple-400 focus:ring-1 focus:ring-purple-400" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0">
                <div class="flex-1">
                    <label for="jenis_kelamin" class="block mb-2 text-purple-400 font-semibold">
                        Jenis Kelamin <span class="text-red-500">*</span>
                    </label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required
                        class="w-full rounded-lg border border-purple-200 px-4 py-2 placeholder-purple-300 focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="flex-1">
                    <label for="whatsapp" class="block mb-2 text-purple-400 font-semibold">
                        Whatsapp <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="whatsapp" id="whatsapp" placeholder="Contoh: 0812xxxxxxx" required
                        class="w-full rounded-lg border border-purple-200 px-4 py-2 placeholder-purple-300 focus:border-purple-400 focus:ring-1 focus:ring-purple-400" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0">
                <div class="flex-1">
                    <label for="pendidikan" class="block mb-2 text-purple-400 font-semibold">
                        Pendidikan
                    </label>
                    <input type="text" name="pendidikan" id="pendidikan" placeholder="Contoh: SMA"
                        class="w-full rounded-lg border border-purple-200 px-4 py-2 placeholder-purple-300 focus:border-purple-400 focus:ring-1 focus:ring-purple-400" />
                </div>

                <div class="flex-1">
                    <label for="tanggal_lahir" class="block mb-2 text-purple-400 font-semibold">
                        Tanggal Lahir <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                        class="w-full rounded-lg border border-purple-200 px-4 py-2 placeholder-purple-300 focus:border-purple-400 focus:ring-1 focus:ring-purple-400" />
                </div>
            </div>

            <div>
                <label for="keluhan" class="block mb-2 text-purple-400 font-semibold">Keluhan</label>
                <textarea name="keluhan" id="keluhan" rows="4" placeholder="Tulis keluhan pasien di sini..."
                    class="w-full rounded-lg border border-purple-200 px-4 py-2 placeholder-purple-300 focus:border-purple-400 focus:ring-1 focus:ring-purple-400 resize-y"></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-purple-400 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                    <i class="fas fa-check"></i>
                    Reservasi
                </button>
            </div>
        </form>
    </div>
</body>

</html>
