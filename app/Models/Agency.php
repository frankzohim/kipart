<?php

namespace App\Models;

use App\Models\Bus;
use App\Models\Horaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agency extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'headquarters',
        'logo',
        'numberOfBus',
        'state'
    ];

    public function buses():HasMany
    {
        return $this->hasMany(Bus::class);
    }

    public function horaires():BelongsToMany
    {
        return $this->belongsToMany(Horaire::class);
    }
}
