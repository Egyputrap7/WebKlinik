<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
   public function handle($request, Closure $next)
    {
        // Cek apakah user sudah login sebagai admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login'); // Pastikan route ini ada
        }

        return $next($request);
    }
}
