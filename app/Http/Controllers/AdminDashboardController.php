<?php

namespace App\Http\Controllers;

use App\Models\KonsultasiMessage;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
   public function index()
    {
        $totalReservasi = Reservasi::count();
        $totalKonsultasi = KonsultasiMessage::count();
        $totalUser = User::where('role', 'pasien')->count(); // asumsi role 'user' untuk user biasa
        $pendingApprovals = Reservasi::where('status', 'pending')->count(); // contoh status pending

        return view('admin.dashboard', compact('totalReservasi', 'totalKonsultasi', 'totalUser', 'pendingApprovals'));
    }
}
