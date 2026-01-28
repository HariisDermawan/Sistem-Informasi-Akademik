<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perkuliahan extends Model
{
    protected $fillable = [
        'matakuliah_id',
        'dosen_id',
        'semester_id',
        'ruangan',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];
}
