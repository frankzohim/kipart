<?php

namespace App\Models;

use App\Models\Agency;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bus extends Model
{
    use HasFactory;

    protected $fillable=[
        'registration',
        'agency_id',
        'number_of_places',
        'classe',
        'plan'
    ];

    public function agency():BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function travel():BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }
}
