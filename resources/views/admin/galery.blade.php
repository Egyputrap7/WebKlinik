<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Galery Admin - Anasera</title>
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

    <main class="container mx-auto p-6 flex-grow">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h2 class="text-xl font-semibold">
                Manajemen Galeri
            </h2>
            <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center gap-2"
                id="btnTambahGaleri" type="button">
                <i class="fas fa-plus">
                </i>
                Tambah Galeri
            </button>
        </div>
        <div class="overflow-x-auto bg-white rounded shadow p-4">
            <table class="min-w-full text-left text-sm" id="tableGaleri">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="p-2">
                            No
                        </th>
                        <th class="p-2">
                            Nama
                        </th>
                        <th class="p-2">
                            Deskripsi
                        </th>
                        <th class="p-2">
                            Gambar
                        </th>
                        <th class="p-2">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody id="galeriTable">
                    <tr class="border-b" data-id="1">
                        <td class="p-2">
                            1
                        </td>
                        <td class="p-2">
                            RESEPSIONIS
                        </td>
                        <td class="p-2">
                            Langkah pertama dimulai dengan sambutan hangat dan senyum yang tulus
                        </td>
                        <td class="p-2">
                            <img alt="A person named Peaches sitting in a stylish room" class="h-16 rounded"
                                height="64" src="{{ asset('uploads/Resepsionis.jpg') }}" width="100" />
                        </td>
                        <td class="p-2 space-x-2 whitespace-nowrap">
                            <button class="text-blue-500 hover:underline btnEdit" type="button">
                                Edit
                            </button>
                            <button class="text-red-500 hover:underline btnHapus" type="button">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b" data-id="2">
                        <td class="p-2">
                            2
                        </td>
                        <td class="p-2">
                            Galeri 2
                        </td>
                        <td class="p-2">
                            Deskripsi singkat galeri 2
                        </td>
                        <td class="p-2">
                            <img alt="Pemandangan pantai dengan pasir putih dan laut biru jernih di bawah langit cerah"
                                class="h-16 rounded" height="64"
                                src="https://storage.googleapis.com/a1aa/image/e170a45b-2470-4e88-ccb4-f9884b74acf2.jpg"
                                width="100" />
                        </td>
                        <td class="p-2 space-x-2 whitespace-nowrap">
                            <button class="text-blue-500 hover:underline btnEdit" type="button">
                                Edit
                            </button>
                            <button class="text-red-500 hover:underline btnHapus" type="button">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b" data-id="3">
                        <td class="p-2">
                            3
                        </td>
                        <td class="p-2">
                            Galeri 3
                        </td>
                        <td class="p-2">
                            Deskripsi singkat galeri 3
                        </td>
                        <td class="p-2">
                            <img alt="Foto lanskap pegunungan dengan kabut pagi dan pepohonan hijau lebat"
                                class="h-16 rounded" height="64"
                                src="https://storage.googleapis.com/a1aa/image/bd2b16c8-bd5a-4679-6183-719f6b987d42.jpg"
                                width="100" />
                        </td>
                        <td class="p-2 space-x-2 whitespace-nowrap">
                            <button class="text-blue-500 hover:underline btnEdit" type="button">
                                Edit
                            </button>
                            <button class="text-red-500 hover:underline btnHapus" type="button">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <!-- Modal -->
    <div aria-hidden="true" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden"
        id="modalGaleri">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <button aria-label="Close modal"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 focus:outline-none" id="modalCloseBtn"
                type="button">
                <i class="fas fa-times text-xl">
                </i>
            </button>
            <h3 class="text-lg font-semibold mb-4" id="modalTitle">
                Tambah Galeri
            </h3>
            <form class="space-y-4" id="formGaleri" novalidate="">
                <div>
                    <label class="block mb-1 font-medium" for="inputNama">
                        Nama
                    </label>
                    <input
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"
                        id="inputNama" name="nama" required="" type="text" />
                </div>
                <div>
                    <label class="block mb-1 font-medium" for="inputDeskripsi">
                        Deskripsi
                    </label>
                    <textarea class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"
                        id="inputDeskripsi" name="deskripsi" required="" rows="3"></textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium" for="inputGambar">
                        Gambar (URL)
                    </label>
                    <input
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"
                        id="inputGambar" name="gambar" placeholder="https://placehold.co/100x64" required=""
                        type="url" />
                </div>
                <div>
                    <label class="block mb-1 font-medium" for="previewGambar">
                        Pratinjau Gambar
                    </label>
                    <img alt="Pratinjau gambar galeri yang akan ditambahkan atau diedit"
                        class="w-40 h-24 object-cover rounded border border-gray-300" height="64"
                        id="previewGambar"
                        src="https://storage.googleapis.com/a1aa/image/4ae7401c-c61d-4162-f89c-84ce7f7ca2d6.jpg"
                        width="100" />
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" id="btnCancel"
                        type="button">
                        Batal
                    </button>
                    <button class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700" id="btnSubmit"
                        type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        const modal = document.getElementById('modalGaleri');
        const modalTitle = document.getElementById('modalTitle');
        const btnTambahGaleri = document.getElementById('btnTambahGaleri');
        const modalCloseBtn = document.getElementById('modalCloseBtn');
        const btnCancel = document.getElementById('btnCancel');
        const formGaleri = document.getElementById('formGaleri');
        const inputNama = document.getElementById('inputNama');
        const inputDeskripsi = document.getElementById('inputDeskripsi');
        const inputGambar = document.getElementById('inputGambar');
        const previewGambar = document.getElementById('previewGambar');
        const galeriTable = document.getElementById('galeriTable');
        let editMode = false;
        let editRow = null;

        // Open modal for adding new gallery
        btnTambahGaleri.addEventListener('click', () => {
            editMode = false;
            editRow = null;
            modalTitle.textContent = 'Tambah Galeri';
            formGaleri.reset();
            previewGambar.src = "https://placehold.co/100x64?text=Preview";
            modal.classList.remove('hidden');
            inputNama.focus();
        });

        // Close modal function
        function closeModal() {
            modal.classList.add('hidden');
            formGaleri.reset();
            previewGambar.src = "https://placehold.co/100x64?text=Preview";
            editRow = null;
            editMode = false;
        }

        modalCloseBtn.addEventListener('click', closeModal);
        btnCancel.addEventListener('click', closeModal);

        // Update preview image when inputGambar changes
        inputGambar.addEventListener('input', () => {
            const url = inputGambar.value.trim();
            if (url) {
                previewGambar.src = url;
            } else {
                previewGambar.src = "https://placehold.co/100x64?text=Preview";
            }
        });

        // Validate URL format (basic)
        function isValidUrl(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }

        // Handle form submit for add/edit
        formGaleri.addEventListener('submit', (e) => {
            e.preventDefault();

            const nama = inputNama.value.trim();
            const deskripsi = inputDeskripsi.value.trim();
            const gambar = inputGambar.value.trim();

            if (!nama || !deskripsi || !gambar || !isValidUrl(gambar)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Semua field harus diisi dan gambar harus berupa URL yang valid.',
                });
                return;
            }

            if (editMode && editRow) {
                // Update existing row
                editRow.querySelector('td:nth-child(2)').textContent = nama;
                editRow.querySelector('td:nth-child(3)').textContent = deskripsi;
                const img = editRow.querySelector('td:nth-child(4) img');
                img.src = gambar;
                img.alt = `Gambar galeri ${editRow.dataset.id}`;

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data galeri berhasil diperbarui.',
                    timer: 1500,
                    showConfirmButton: false,
                });
            } else {
                // Add new row
                const newId = getNextId();
                const newRow = document.createElement('tr');
                newRow.classList.add('border-b');
                newRow.dataset.id = newId;

                newRow.innerHTML = `
               <td class="p-2">${galeriTable.children.length + 1}</td>
               <td class="p-2">${escapeHtml(nama)}</td>
               <td class="p-2">${escapeHtml(deskripsi)}</td>
               <td class="p-2">
                   <img src="${escapeHtml(gambar)}" alt="Gambar galeri ${newId}" class="h-16 rounded" width="100" height="64" />
               </td>
               <td class="p-2 space-x-2 whitespace-nowrap">
                   <button type="button" class="text-blue-500 hover:underline btnEdit">Edit</button>
                   <button type="button" class="text-red-500 hover:underline btnHapus">Hapus</button>
               </td>
           `;

                galeriTable.appendChild(newRow);
                updateRowNumbers();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Galeri baru berhasil ditambahkan.',
                    timer: 1500,
                    showConfirmButton: false,
                });
            }

            closeModal();
        });

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            return text.replace(/[&<>"']/g, function(m) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [m];
            });
        }

        // Get next ID for new gallery item
        function getNextId() {
            let maxId = 0;
            galeriTable.querySelectorAll('tr').forEach(row => {
                const id = parseInt(row.dataset.id, 10);
                if (id > maxId) maxId = id;
            });
            return maxId + 1;
        }

        // Update the numbering column after add/delete
        function updateRowNumbers() {
            galeriTable.querySelectorAll('tr').forEach((row, index) => {
                row.querySelector('td:first-child').textContent = index + 1;
            });
        }

        // Delegate edit and delete buttons
        galeriTable.addEventListener('click', (e) => {
            if (e.target.classList.contains('btnEdit')) {
                const row = e.target.closest('tr');
                editMode = true;
                editRow = row;
                modalTitle.textContent = 'Edit Galeri';

                inputNama.value = row.querySelector('td:nth-child(2)').textContent;
                inputDeskripsi.value = row.querySelector('td:nth-child(3)').textContent;
                inputGambar.value = row.querySelector('td:nth-child(4) img').src;
                previewGambar.src = inputGambar.value;

                modal.classList.remove('hidden');
                inputNama.focus();
            } else if (e.target.classList.contains('btnHapus')) {
                const row = e.target.closest('tr');
                const id = row.dataset.id;
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data galeri akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        row.remove();
                        updateRowNumbers();
                        Swal.fire({
                            title: 'Terhapus!',
                            text: `Galeri dengan ID ${id} telah dihapus.`,
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });

        // Close modal on Escape key
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
</body>

</html>
