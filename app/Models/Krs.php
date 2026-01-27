<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $fillable = ['mahasiswa_id', 'perkuliahan_id', 'status'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
    public function perkuliahan()
    {
        return $this->belongsTo(Perkuliahan::class);
    }
    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',        
        'updated_at',
    ];
}
