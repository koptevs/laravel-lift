<?php

namespace App\Models;

use Database\Factories\LiftFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lift extends Model
{
    use HasFactory;
//protected $table = 'lift'  ik - если хотим поменять дефолтную lifts
    //protected $guarded = ['id']; //lara22

//    protected $fillable =
//        [
//            'lift_manager_id',
//            'reg_number',
//            'lift_type',
//            'manufacturer_name'
//        ];

//    public function getRouteKeyName(): string
//    {
//        return 'reg_number'; //lara23 read!
//    }

    public function lift_manager()
    {
        return $this->belongsTo(LiftManager::class);
    }

    protected static function newFactory(): LiftFactory
    {
        return new LiftFactory();
    }
}
