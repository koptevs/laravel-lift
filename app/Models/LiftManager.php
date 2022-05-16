<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftManager extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'address',
            'reg_number',
        ];

    public function lifts()
    {
        return $this->hasMany(Lift::class);
    }
}
