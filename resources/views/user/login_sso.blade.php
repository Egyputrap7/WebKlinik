<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Klinik Anasera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5" style="max-width: 400px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-4 text-center">Login Klinik Anasera</h3>

                {{-- Notifikasi error --}}
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Form login default Laravel --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        Login
                    </button>
                </form>

                <hr>

                {{-- Tombol Login dengan Google --}}
                <a href="{{ route('auth.google') }}" class="btn btn-danger w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; vertical-align: middle;"
                        viewBox="0 0 48 48">
                        <path fill="#4285F4"
                            d="M24 9.5c3.7 0 7.1 1.3 9.7 3.7l7.3-7.3C35.4 2.6 30.1 0 24 0 14.8 0 6.9 5.5 3.1 13.4l8.6 6.7c1.7-5 6.2-10.6 12.3-10.6z" />
                        <path fill="#34A853"
                            d="M46.5 24.5c0-1.5-.1-2.8-.4-4.1H24v7.9h12.6c-.6 3.5-2.7 6.3-5.7 8.3l8.6 6.7c5-4.7 7.9-11.4 7.9-18.8z" />
                        <path fill="#FBBC05"
                            d="M11.7 29.4c-1.4-4.3-1.4-9 0-13.3l-8.6-6.7C-2.1 14.1-2.1 33.9 3.1 41.6l8.6-6.7z" />
                        <path fill="#EA4335"
                            d="M24 48c6.1 0 11.4-2 15.2-5.4l-8.6-6.7c-2.5 1.7-5.7 2.7-8.9 2.7-6.1 0-10.6-5.7-12.3-10.6l-8.6 6.7C6.9 42.5 14.8 48 24 48z" />
                    </svg>
                    <span style="margin-left: 8px;">Login dengan Google</span>
                </a>

            </div>
        </div>
    </div>

</body>

</html>
