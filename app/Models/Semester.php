<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = ['nama_semester', 'is_aktif'];

    public function perkuliahans()
    {
        return $this->hasMany(Perkuliahan::class);
    }

    protected $hidden = [
        'created_at',        
        'updated_at',
    ];
}
