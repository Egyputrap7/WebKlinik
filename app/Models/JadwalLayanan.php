<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLayanan extends Model
{
   use HasFactory;

    // Nama tabel jika tidak sesuai konvensi (opsional karena sudah sesuai)
    protected $table = 'jadwal_layanans';

    // Mass assignable fields
    protected $fillable = [
        'hari',
        'tanggal',
        'layanan',
        'status',
        'jam_operasional',
        'kuota',
    ];

    // Relasi ke reservasi
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'jadwal_id');
    }
}
