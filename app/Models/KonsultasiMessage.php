<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiMessage extends Model
{
     use HasFactory;

   protected $fillable = [
    'konsultasi_id',
    'user_id',
    'admin_id',
    'sender_type',
    'isi',
];

    public function konsultasi()
    {
        return $this->belongsTo(Konsultasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
