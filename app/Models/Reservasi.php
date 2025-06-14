<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'nama_pasien',
        'umur',
        'jenis_kelamin',
        'whatsapp',
        'pendidikan',
        'tanggal_lahir',
        'keluhan',
        'jadwal_reservasi',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'jadwal_reservasi' => 'datetime', // ← ganti dari 'date' ke 'datetime'
    ];
}
