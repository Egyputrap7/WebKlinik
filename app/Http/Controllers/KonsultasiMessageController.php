<?php

namespace App\Http\Controllers;

use App\Events\KonsultasiMessageEvent;
use App\Models\Konsultasi;
use App\Models\KonsultasiMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiMessageController extends Controller
{
public function store(Request $request)
    {
        $request->validate([
            'konsultasi_id' => 'required|exists:konsultasis,id',
            'isi' => 'required|string',
        ]);

        $isAdmin = Auth::guard('admin')->check();
        $user = Auth::guard('web')->user();
        $admin = Auth::guard('admin')->user();

        $message = KonsultasiMessage::create([
            'konsultasi_id' => $request->konsultasi_id,
            'isi' => $request->isi,
            'user_id' => $isAdmin ? null : $user->id,
            'admin_id' => $isAdmin ? $admin->id : null,
            'sender_type' => $isAdmin ? 'admin' : 'user',
            'is_read' => false,
        ]);

        broadcast(new KonsultasiMessageEvent($message, $request->konsultasi_id))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }

    // Tambahkan ini
    public function markAsRead($id)
    {
        try {
            // Tandai semua pesan dari user (yang belum dibaca) dalam konsultasi tertentu
            KonsultasiMessage::where('konsultasi_id', $id)
                ->whereNull('admin_id') // berarti ini pesan dari user
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json([
                'status' => 'success',
                'message' => 'Semua pesan user ditandai sebagai dibaca.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menandai pesan sebagai dibaca.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
    $konsultasi = Konsultasi::findOrFail($id);

    return view('user.konsultasi.show', compact('konsultasi'));
    }
}
