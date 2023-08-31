<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kebun', 'farmer_id', 'luas', 'jarak', 'umur', 'jenis_tanah'];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
