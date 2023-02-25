<?php

namespace App\Models;

use App\Models\Agency;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    use HasFactory;

    protected $fillable=[
        'registration',
        'number_of_places',
        'classe',
        'agency_id',
        'travel_id',
        'plan'
    ];


    public function travels():HasMany
    {
        return $this->hasMany(Travel::class);
    }
}
