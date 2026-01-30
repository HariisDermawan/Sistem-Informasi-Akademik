<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['user_id', 'prodi_id', 'nidn', 'nama_dosen', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
    public function perkuliahans()
    {
        return $this->hasMany(Perkuliahan::class);
    }


    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',        
        'updated_at',
    ];
}
