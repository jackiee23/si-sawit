<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $fillable=['nama', 'alamat', 'nik', 'no_wa', 'luas', 'jarak', 'umur', 'jenis_tanah'];

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

    public function farm()
    {
        return $this->hasMany(Farm::class);
    }
}
