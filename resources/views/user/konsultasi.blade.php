<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Pengembangan Website ANASERA sebagai Pusat Terapi Tumbuh Kembang Anak
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-image: url("{{ asset('uploads/bg.jpg') }}");
            background-size: cover;
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
    <div>
        <div class="container p-2 mx-auto max-w-8xl">
            <div id="chat-container" class="flex flex-col md:flex-row h-[700px] rounded-lg shadow-2xl overflow-hidden"
                style="background: linear-gradient(135deg, #a78bfa, #f9a8d4, #93c5fd);">
                <!-- Sidebar User List -->
                <div
                    class="overflow-y-auto border-b border-indigo-300 md:w-1/3 md:border-b-0 md:border-r bg-white/80 dark:bg-gray-900/90 dark:border-indigo-700 backdrop-blur-md">
                    <!-- Header -->
                    <div
                        class="flex items-center justify-between gap-3 p-4 border-b border-indigo-200 dark:border-indigo-700">
                        <h5 class="text-lg font-semibold text-indigo-900 dark:text-indigo-300">
                            Daftar Konsultasi
                        </h5>
                        <select id="theme-selector"
                            class="px-2 py-1 text-sm text-indigo-700 transition bg-transparent border border-indigo-300 rounded cursor-pointer dark:border-indigo-700 dark:text-indigo-300">
                            <option value="default" selected>Theme Default</option>
                            <option value="pink">Pink</option>
                            <option value="purple">Ungu</option>
                            <option value="blue">Biru</option>
                            <option value="green">Hijau</option>
                            <option value="orange">Oren</option>
                            <option value="gray">Abu-Abu</option>
                        </select>
                    </div>

                    <!-- List user -->
                    <ul id="user-list" class="divide-y divide-indigo-300 dark:divide-indigo-700">
                        @foreach ($admins as $admin)
                            <li data-id="{{ $admin->id }}" data-type="App\Models\Admin"
                                class="flex items-center px-4 py-3 space-x-3 transition-colors duration-300 cursor-pointer hover:bg-indigo-200 dark:hover:bg-indigo-700">
                                <div
                                    class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-full shadow-lg bg-gradient-to-tr from-purple-500 via-pink-500 to-blue-400">
                                    {{ strtoupper(substr($admin->username, 0, 1)) }}
                                </div>
                                <span
                                    class="font-medium text-indigo-900 truncate dark:text-indigo-100">{{ $admin->username }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Chat Area -->
                <div class="flex flex-col md:w-2/3 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md">
                    <div id="chat-box"
                        class="flex-1 p-6 space-y-4 overflow-y-auto scrollbar-thin scrollbar-thumb-indigo-400 scrollbar-track-transparent">
                        <p class="italic text-center text-indigo-600 select-none dark:text-indigo-400">Pilih user untuk
                            mulai chat</p>
                    </div>

                    <div
                        class="flex items-center justify-between p-4 space-x-3 border-t border-indigo-300 dark:border-indigo-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm">
                        <div class="flex items-center space-x-2">
                            <label for="bubble-color"
                                class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">Warna
                                Bubble:</label>
                            <select id="bubble-color"
                                class="px-2 py-1 text-indigo-700 transition border border-indigo-300 rounded cursor-pointer dark:border-indigo-700 dark:text-indigo-300">
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
                                class="flex-1 px-4 py-2 transition border border-indigo-300 rounded-lg dark:border-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                                disabled>
                            <button type="submit"
                                class="px-5 py-2 font-semibold text-white transition-transform transform bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 active:scale-90 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Scrollbar custom */
            #chat-box::-webkit-scrollbar {
                width: 8px;
            }

            #chat-box::-webkit-scrollbar-track {
                background: transparent;
            }

            #chat-box::-webkit-scrollbar-thumb {
                background-color: #818cf8;
                /* indigo-400 */
                border-radius: 10px;
            }

            /* Animations */
            @keyframes fadeInUp {
                0% {
                    opacity: 0;
                    transform: translateY(10px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeInUp 0.3s ease forwards;
            }

            /* Scrollbar for Firefox */
            #chat-box {
                scrollbar-width: thin;
                scrollbar-color: #818cf8 transparent;
            }
        </style>

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
        pink: { sent: '#fbcfe8', received: '#fce7f3' },
        purple: { sent: '#c4b5fd', received: '#ede9fe' },
        blue: { sent: '#93c5fd', received: '#dbeafe' },
        green: { sent: '#bbf7d0', received: '#dcfce7' },
        orange: { sent: '#fed7aa', received: '#ffedd5' },
        gray: { sent: '#e5e7eb', received: '#f3f4f6' }
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
 const currentUserId = {{ auth()->guard('web')->id() ?? 'null' }};
const currentUserType = "App\\Models\\User";
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

    </div>
</body>

</html>
