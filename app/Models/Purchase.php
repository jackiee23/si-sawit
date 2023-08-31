<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function worker(){
        return $this->belongsTo(Worker::class);
    }

    public function farm(){
        return $this->belongsTo(Farm::class);
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
