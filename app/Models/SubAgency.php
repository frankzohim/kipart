<?php

namespace App\Models;

use App\Models\Agency;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubAgency extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;


    protected $guard='agency';
    protected $fillable=[
        'name',
        'localisation',
        'email',
        'password',
        'phone',
        'agency_id'
    ];

    public function agency():BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
