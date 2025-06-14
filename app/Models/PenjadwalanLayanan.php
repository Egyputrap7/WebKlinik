<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjadwalanLayanan extends Model
{
    protected $table = 'jadwal_layanan';

    protected $fillable = [
        'date',
        'status',
        'hours',
        'reservation',
    ];

    public $timestamps = true; // aktifkan jika ingin menyimpan created_at dan updated_at
}
