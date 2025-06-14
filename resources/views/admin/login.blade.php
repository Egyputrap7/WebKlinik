<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin - ANASERA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-white text-gray-800">

    <!-- Login Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto">
            <div class="max-w-md mx-auto bg-gray-100 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-6 text-center">Login Admin</h2>
                <form id="loginForm">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="username">Username</label>
                        <input id="username" type="text" class="w-full p-2 border rounded" placeholder="Username"
                            required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                        <input id="password" type="password" class="w-full p-2 border rounded" placeholder="Password"
                            required>
                    </div>
                    <div class="flex justify-between items-center">
                        <button type="submit"
                            class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">Sign
                            In</button>
                        <a href="#" class="text-pink-500 hover:text-pink-800 text-sm font-semibold">Forgot
                            Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch("/admin/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        username,
                        password
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    alert("Login berhasil!");
                    window.location.href = data.redirect || "/admin/dashboard";
                } else {
                    alert(data.message || "Login gagal.");
                }
            } catch (error) {
                console.error(error);
                alert("Terjadi kesalahan.");
            }
        });
    </script>
</body>

</html>
