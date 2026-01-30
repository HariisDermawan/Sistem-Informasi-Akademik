<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $fillable = ['prodi_id', 'dosen_id', 'kode_mk', 'nama_mk', 'sks'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
