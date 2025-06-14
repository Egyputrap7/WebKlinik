<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
   use HasFactory;

    protected $fillable = [
        'judul',
        'user_id', // yang membuat konsultasi (misalnya user)
    ];

    public function messages()
    {
        return $this->hasMany(KonsultasiMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
    return $this->belongsTo(Admin::class);
    }

}
