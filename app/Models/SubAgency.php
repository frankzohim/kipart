<?php

namespace App\Models;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubAgency extends Model
{
    use HasFactory;

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
