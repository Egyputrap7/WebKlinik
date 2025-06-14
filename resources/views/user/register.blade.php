<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md p-8 bg-gray-100 rounded shadow">
            <h2 class="text-2xl font-bold mb-6 text-center">Register User</h2>
            <form id="registerForm">
                <div class="mb-4">
                    <label class="block">Name</label>
                    <input name="name" id="name" type="text" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Email</label>
                    <input name="email" id="email" type="email" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Password</label>
                    <input name="password" id="password" type="password" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-6">
                    <label class="block">Confirm Password</label>
                    <input name="password_confirmation" id="password_confirmation" type="password"
                        class="w-full border rounded p-2" required>
                </div>

                <button type="submit" class="w-full bg-pink-500 text-white font-bold py-2 rounded hover:bg-pink-700">
                    Register
                </button>
            </form>

            <p class="text-sm mt-4 text-center">
                Sudah punya akun? <a href="/login" class="text-pink-600 font-semibold">Login di sini</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const csrf = document.querySelector('meta[name="csrf-token"]').content;

            console.log("=== Isi FormData ===");
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            try {
                const res = await fetch("/register", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrf,
                        "Accept": "application/json"
                    },

                    credentials: "same-origin",
                    body: formData
                });

                const data = await res.json();

                if (res.ok) {
                    alert("Registrasi berhasil!");
                    window.location.href = "/login";
                } else {
                    alert(data.message || "Registrasi gagal!");
                }
            } catch (err) {
                alert("Terjadi kesalahan. Coba lagi.");
                console.error(err);
            }
        });
    </script>
</body>

</html>
