<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PenjadwalanLayanan;


class LayananController extends Controller
{
    public function index()
{
    $timezone = 'Asia/Jakarta';
    $startDate = Carbon::now()->setTimezone($timezone)->startOfDay();
    $quotaPerDay = 7;

    $dates = [];

    for ($i = 0; $i < 7; $i++) {
        $date = $startDate->copy()->addDays($i);
        $formattedDate = $date->format('Y-m-d');

        // Hitung jumlah reservasi untuk tanggal ini
        $count = Reservasi::whereDate('jadwal_reservasi', $date)->count();
        $available = $quotaPerDay - $count;
        if ($available < 0) $available = 0;

        // Tambahkan status kuota
        if ($count >= $quotaPerDay) {
            $quotaStatus = 'Full Booked';
        } elseif ($count >= $quotaPerDay - 2) {
            $quotaStatus = 'Hampir Penuh';
        } else {
            $quotaStatus = 'Tersedia';
        }

        // Cek apakah ada jadwal custom dari database
        $jadwal = PenjadwalanLayanan::whereDate('date', $formattedDate)->first();

        if ($jadwal) {
            $dates[] = [
                'date' => $jadwal->date,
                'day' => $date->locale('id')->translatedFormat('l'),
                'status' => $jadwal->status,
                'hours' => $jadwal->hours,
                'reservation' => $jadwal->reservation,
                'quota_used' => $count,
                'quota_label' => $count . '/' . $quotaPerDay,
                'is_full' => $count >= $quotaPerDay,
                'quota_status' => $quotaStatus,
            ];
        } else {
            $status = $available > 0 ? 'Buka' : 'Penuh';
            $reservation = $available > 0 ? 'Tersedia' : 'Full Booked';
            $hours = $available > 0 ? '08:00 - 16:00' : '-';

            $dates[] = [
                'date' => $formattedDate,
                'day' => $date->locale('id')->translatedFormat('l'),
                'status' => $status,
                'hours' => $hours,
                'reservation' => $reservation,
                'quota_used' => $count,
                'quota_label' => $count . '/' . $quotaPerDay,
                'is_full' => $count >= $quotaPerDay,
                'quota_status' => $quotaStatus,
            ];
        }
    }

    if (Auth::guard('admin')->check()) {
        return view('admin.layanan', compact('dates'));
    }

    return view('user.layanan', compact('dates'));
}


    public function update(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'status' => 'required|string',
            'hours' => 'required|string',
            'reservation' => 'required|string',
        ]);

        PenjadwalanLayanan::updateOrCreate(
            ['date' => $data['date']],
            [
                'status' => $data['status'],
                'hours' => $data['hours'],
                'reservation' => $data['reservation']
            ]
        );

        return response()->json(['success' => true]);
    }
}
