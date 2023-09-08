<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function repayment()
    {
        return $this->hasMany(Repayment::class);
    }
}
