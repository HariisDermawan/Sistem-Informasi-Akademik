<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['user_id', 'prodi_id', 'nim', 'nama_mahasiswa', 'angkatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
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
