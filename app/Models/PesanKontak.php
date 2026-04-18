<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $table = 'pesan_kontak';
    protected $primaryKey = 'id_pesan';
    
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
    
    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'no_whatsapp',
        'subjek',
        'pesan',
        'status_pesan',
        'dibaca_pada',
        'dibalas_pada',
    ];
    
    protected $casts = [
        'dibaca_pada' => 'datetime',
        'dibalas_pada' => 'datetime',
        'created_at' => 'datetime',
    ];
}