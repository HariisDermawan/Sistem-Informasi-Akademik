<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi_dosen extends Model
{
    protected $fillable = ['perkuliahan_id', 'tanggal', 'pertemuan_ke'];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',        
        'updated_at',
    ];
}
