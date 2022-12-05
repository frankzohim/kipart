<?php

namespace App\Models;

use App\Models\Bus;
use App\Models\Path;
use App\Models\Travel;
use App\Models\Horaire;
use App\Models\Schedule;
use App\Models\Itinerary;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agency extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $fillable=[
        'name',
        'headquarters',
        'logo',
        'phone_number',
        'state',
        'password'
    ];

    protected $guard='agency';

    public function buses():HasMany
    {
        return $this->hasMany(Bus::class);
    }

    public function schedules():BelongsToMany
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function travels():HasMany
    {
        return $this->hasMany(Travel::class);
    }

    public function paths():BelongsToMany
    {
        return $this->belongsToMany(Path::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
