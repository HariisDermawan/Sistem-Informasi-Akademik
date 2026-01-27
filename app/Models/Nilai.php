<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['krs_id', 'nilai_angka', 'nilai_huruf'];

    public function krs()
    {
        return $this->belongsTo(Krs::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',        
        'updated_at',
    ];
}
