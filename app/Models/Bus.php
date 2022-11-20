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
        'immatriculation',
        'agence_id',
        'number_of_places',
        'classe'
    ];

    public function agency():BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
