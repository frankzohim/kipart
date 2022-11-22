<?php

namespace App\Models;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable=[
        'departure',
        'arrival',
        'state',
    ];

    public function agency():BelongsToMany
    {
        return $this->belongsToMany(Agency::class);
    }
}
