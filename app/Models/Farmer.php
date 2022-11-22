<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $fillable=['nama', 'alamat', 'no_wa', 'luas', 'jarak', 'umur'];

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
