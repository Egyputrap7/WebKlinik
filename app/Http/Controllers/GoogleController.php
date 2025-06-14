<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleController extends Controller
{
    // Redirect ke Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }


    // Callback dari Google
    public function handleGoogleCallback()
{
    try {


         $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt('password'), // bisa diganti random
            ]
        );

        Auth::login($user);

        return redirect()->intended('/layanan');

    } catch (InvalidStateException $e) {
    Log::error('Invalid state saat login Google', [
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
    ]);
    return redirect('/login')->with('error', 'Login gagal: invalid state (session/csrf mungkin tidak cocok).');
} catch (ClientException $e) {
    Log::error('Client exception dari Google', [
        'response' => $e->getResponse()->getBody()->getContents(),
    ]);
    return redirect('/login')->with('error', 'Login gagal: token tidak valid atau akses ditolak.');
} catch (\Throwable $e) {
    Log::error('Exception umum saat login Google', [
        'message' => $e->getMessage(),
        'type' => get_class($e),
        'trace' => $e->getTraceAsString(),
    ]);
    return redirect('/login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
}
}

    public function showLoginForm()
    {
        return view('user.login_sso'); // pastikan ini view login kamu
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role admin
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'Anda bukan admin'])->withInput();
            }

            return redirect()->intended('/admin/dashboard'); // ganti dengan route admin
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login_sso');
    }
}
