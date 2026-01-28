<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi_mahasiswa extends Model
{
    protected $fillable = ['krs_id', 'presensi_dosen_id', 'status'];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    public function presensi_dosen()
    {
        return $this->belongsTo(Presensi_dosen::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',        
        'updated_at',
    ];
}


