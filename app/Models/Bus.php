<?php

namespace App\Models;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bus extends Model
{
    use HasFactory;

    protected $fillable=[
        'registration',
        'agence_id',
        'number_of_places',
        'class'
    ];

    public function agency():BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
