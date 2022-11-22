<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function fuels()
    {
        return $this->hasMany(Fuel::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
