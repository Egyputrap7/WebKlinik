<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // Tampilkan tabel kuota per tanggal (misal 7 hari ke depan dari hari ini)
    public function index()
    {
        // Gunakan timezone Asia/Jakarta (WIB)
        $timezone = 'Asia/Jakarta';
        $startDate = Carbon::now($timezone)->startOfDay();
        $quotaPerDay = 7;

        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $count = Reservasi::whereDate('jadwal_reservasi', $date)->count();

            $available = $quotaPerDay - $count;
            if ($available < 0) $available = 0;

            $status = $available > 0 ? 'Tersedia' : 'Penuh';

            $dates[] = [
                'tanggal' => $date->format('Y-m-d'),
                'available' => $available,
                'status' => $status,
            ];
        }

        return redirect()->route('user.layanan')->with('success', 'Reservasi berhasil');
    }

    // Tampilkan form reservasi untuk tanggal tertentu
    public function create($tanggal)
    {
        $timezone = 'Asia/Jakarta';

        // Validasi format tanggal
        try {
            $date = Carbon::createFromFormat('Y-m-d', $tanggal, $timezone)->startOfDay();
        } catch (\Exception $e) {
            abort(404);
        }

        $today = Carbon::now($timezone)->startOfDay();

        // Cek apakah tanggal sudah lewat atau kurang dari hari ini
        if ($date->lt($today)) {
            return redirect()->route('reservasi.index')->with('error', 'Tanggal reservasi sudah lewat.');
        }

        // Cek kuota
        $count = Reservasi::whereDate('jadwal_reservasi', $date)->count();
        if ($count >= 7) {
            return redirect()->route('reservasi.index')->with('error', 'Kuota pada tanggal ini sudah penuh.');
        }

        return view('user.form_reservasi', ['tanggal' => $tanggal]);
    }

    // Proses simpan reservasi
    public function store(Request $request)
    {
        $timezone = 'Asia/Jakarta';

        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'umur' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:L,P',
            'whatsapp' => 'required|string|max:20',
            'pendidikan' => 'nullable|string|max:100',
            'tanggal_lahir' => 'required|date',
            'keliah' => 'nullable|string|max:255',
            'jadwal_reservasi' => 'required|date',
        ]);

        // Validasi tanggal reservasi tidak lewat hari ini
        try {
            $jadwal = Carbon::createFromFormat('Y-m-d', $request->jadwal_reservasi, $timezone)->startOfDay();
        } catch (\Exception $e) {
            return back()->withErrors(['jadwal_reservasi' => 'Format tanggal reservasi tidak valid'])->withInput();
        }

        $today = Carbon::now($timezone)->startOfDay();
        if ($jadwal->lt($today)) {
            return back()->withErrors(['jadwal_reservasi' => 'Tanggal reservasi sudah lewat'])->withInput();
        }

        // Cek kuota
        $count = Reservasi::whereDate('jadwal_reservasi', $jadwal)->count();
        if ($count >= 7) {
            return back()->withErrors(['jadwal_reservasi' => 'Kuota pada tanggal ini sudah penuh.'])->withInput();
        }

        // Simpan data
        Reservasi::create($request->all());

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dibuat!');
    }

    public function adminIndex()
    {
        $reservasis = Reservasi::orderBy('jadwal_reservasi', 'desc')->get(); // atau pakai paginate()
        return view('admin.reservasi', compact('reservasis'));
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
    }
    public function accept($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = 'accepted';
        $reservasi->save();

        return redirect()->back()->with('success', 'Reservasi diterima.');
    }
}
