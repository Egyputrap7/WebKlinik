<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Konsultasi Admin - Konsultasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
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

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>

        </nav>
    </header>

    <div class="container p-2 mx-auto max-w-8xl">
        <div id="chat-container" class="flex flex-col md:flex-row h-[700px] rounded-lg shadow-2xl overflow-hidden"
            style="background: linear-gradient(135deg, #a78bfa, #f9a8d4, #93c5fd);">

            <!-- Sidebar User List -->
            <div class="overflow-y-auto border-r border-indigo-300 md:w-1/3 bg-white/80 backdrop-blur-md">
                <div class="flex items-center justify-between p-4 border-b border-indigo-200">
                    <h5 class="text-lg font-semibold text-indigo-900">Daftar Konsultasi</h5>
                    <select id="theme-selector"
                        class="px-2 py-1 text-sm text-indigo-700 border border-indigo-300 rounded">
                        <option value="default" selected>Theme Default</option>
                        <option value="pink">Pink</option>
                        <option value="purple">Ungu</option>
                        <option value="blue">Biru</option>
                        <option value="green">Hijau</option>
                        <option value="orange">Oren</option>
                        <option value="gray">Abu-Abu</option>
                    </select>
                </div>

                <ul id="user-list" class="divide-y divide-indigo-300">
                    @foreach ($users as $user)
                        <li data-id="{{ $user->id }}" data-type="App\Models\User"
                            class="flex items-center px-4 py-3 space-x-3 cursor-pointer hover:bg-indigo-200">
                            <div
                                class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-full shadow bg-gradient-to-tr from-purple-500 via-pink-500 to-blue-400">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-indigo-900 truncate">{{ $user->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Chat Area -->
            <div class="flex flex-col md:w-2/3 bg-white/90 backdrop-blur-md">
                <div id="chat-box"
                    class="flex-1 p-6 space-y-4 overflow-y-auto scrollbar-thin scrollbar-thumb-indigo-400 scrollbar-track-transparent">
                    <p class="italic text-center text-indigo-600 select-none">Pilih user untuk mulai chat</p>
                </div>

                <div
                    class="flex items-center justify-between p-4 space-x-3 border-t border-indigo-300 bg-white/80 backdrop-blur-sm">
                    <div class="flex items-center space-x-2">
                        <label for="bubble-color" class="text-sm font-semibold text-indigo-700">Warna Bubble:</label>
                        <select id="bubble-color"
                            class="px-2 py-1 text-indigo-700 border border-indigo-300 rounded cursor-pointer">
                            <option value="pink">Pink</option>
                            <option value="purple" selected>Ungu</option>
                            <option value="blue">Biru</option>
                            <option value="green">Hijau</option>
                            <option value="orange">Oren</option>
                            <option value="gray">Abu-Abu</option>
                        </select>
                    </div>

                    <form id="chat-form" class="flex items-center flex-1 space-x-3">
                        @csrf
                        <input type="hidden" id="receiver_id" name="receiver_id">
                        <input type="text" id="message" name="message" placeholder="Tulis pesan..."
                            autocomplete="off"
                            class="flex-1 px-4 py-2 border border-indigo-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            disabled>
                        <button type="submit"
                            class="px-5 py-2 font-semibold text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedUserId = null;
        let selectedUserType = null;

        const chatBox = document.getElementById('chat-box');
        const userList = document.getElementById('user-list');
        const chatForm = document.getElementById('chat-form');
        const receiverInput = document.getElementById('receiver_id');
        const messageInput = document.getElementById('message');
        const bubbleColorSelect = document.getElementById('bubble-color');
        const themeSelector = document.getElementById('theme-selector');
        const chatContainer = document.getElementById('chat-container');

        const bubbleColors = {
            pink: {
                sent: '#fbcfe8',
                received: '#fce7f3'
            },
            purple: {
                sent: '#c4b5fd',
                received: '#ede9fe'
            },
            blue: {
                sent: '#93c5fd',
                received: '#dbeafe'
            },
            green: {
                sent: '#bbf7d0',
                received: '#dcfce7'
            },
            orange: {
                sent: '#fed7aa',
                received: '#ffedd5'
            },
            gray: {
                sent: '#e5e7eb',
                received: '#f3f4f6'
            }
        };

        const themes = {
            default: 'linear-gradient(135deg, #a78bfa, #f9a8d4, #93c5fd)',
            pink: 'linear-gradient(135deg, #f9a8d4, #f472b6, #fbbf24)',
            purple: 'linear-gradient(135deg, #7c3aed, #c4b5fd, #8b5cf6)',
            blue: 'linear-gradient(135deg, #3b82f6, #93c5fd, #60a5fa)',
            green: 'linear-gradient(135deg, #22c55e, #bbf7d0, #4ade80)',
            orange: 'linear-gradient(135deg, #f97316, #fdba74, #fb923c)',
            gray: 'linear-gradient(135deg, #9ca3af, #d1d5db, #6b7280)',
        };

        // Ganti sesuai guard yang sedang aktif
        const currentUserId = {{ auth()->guard('admin')->id() ?? (auth()->guard('web')->id() ?? 'null') }};
        const currentUserType =
            "{{ auth()->guard('admin')->check() ? 'App\\\\Models\\\\Admin' : 'App\\\\Models\\\\User' }}";

        function clearActiveUser() {
            userList.querySelectorAll('li').forEach(li =>
                li.classList.remove('bg-indigo-200')
            );
        }

        function enableChatForm(enable = true) {
            messageInput.disabled = !enable;
            chatForm.querySelector('button[type=submit]').disabled = !enable;
        }

        function fetchMessages(userId) {
            const type = selectedUserType;
            fetch(`/chat/messages/${userId}?type=${encodeURIComponent(type)}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched messages:', data);
                    console.log('Current User ID:', currentUserId);
                    console.log('Current User Type:', currentUserType);
                    console.log(type);
                    chatBox.innerHTML = '';
                    const bubbleTheme = bubbleColors[bubbleColorSelect.value] || bubbleColors.purple;

                    data.forEach(msg => {
                        const div = document.createElement('div');
                        div.textContent = msg.message;
                        div.className =
                            'max-w-[70%] px-5 py-3 rounded-lg break-words animate-fade-in shadow-md';
                        div.style.transition = 'background-color 0.3s ease';

                        if (msg.sender_id == currentUserId && msg.sender_type === currentUserType) {
                            div.style.backgroundColor = bubbleTheme.sent;
                            div.style.alignSelf = 'flex-end';
                            div.style.textAlign = 'right';
                            div.style.borderTopRightRadius = '0';
                            div.style.marginLeft = 'auto';
                        } else {
                            div.style.backgroundColor = bubbleTheme.received;
                            div.style.alignSelf = 'flex-start';
                            div.style.textAlign = 'left';
                            div.style.borderTopLeftRadius = '0';
                            div.style.marginRight = 'auto';
                        }

                        chatBox.appendChild(div);
                    });

                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(error => {
                    chatBox.innerHTML = '<p class="italic text-center text-red-500">Gagal memuat pesan</p>';
                    console.error(error);
                });
        }

        userList.querySelectorAll('li').forEach(item => {
            item.addEventListener('click', () => {
                clearActiveUser();
                selectedUserId = item.getAttribute('data-id');
                selectedUserType = item.getAttribute('data-type');
                receiverInput.value = selectedUserId;
                chatBox.innerHTML = '<p class="italic text-center text-indigo-600">Loading...</p>';
                chatForm.classList.remove('hidden');
                enableChatForm(true);
                item.classList.add('bg-indigo-200');
                fetchMessages(selectedUserId);
            });
        });

        chatForm.addEventListener('submit', e => {
            e.preventDefault();
            const message = messageInput.value.trim();
            if (!message) return;

            fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        receiver_id: selectedUserId,
                        receiver_type: selectedUserType,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    messageInput.value = '';
                    fetchMessages(selectedUserId);
                })
                .catch(error => {
                    console.error("Gagal mengirim pesan:", error);
                });
        });

        bubbleColorSelect.addEventListener('change', () => {
            if (selectedUserId) fetchMessages(selectedUserId);
        });

        themeSelector.addEventListener('change', () => {
            updateTheme(themeSelector.value);
        });

        function updateTheme(theme) {
            chatContainer.style.background = themes[theme] || themes.default;
        }

        updateTheme('default');
        enableChatForm(false);
    </script>


</body>

</html>
