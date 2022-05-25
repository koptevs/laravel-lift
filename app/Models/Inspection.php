<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $casts = [
        'inspection_participants' => 'array'
    ];

    protected $fillable =
        [
            'lift_id',
            'inspection_date',
            'inspection_protocol',
            'inspection_label',
            'inspection_result',
            'inspection_participant_1_profession',
            'inspection_participant_1_name',
            'inspection_participant_2_profession',
            'inspection_participant_2_name',
            'inspecion_type',
            'incpection_notes',
        ];

    public function lift(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lift::class);
    }
}
