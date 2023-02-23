<?php

namespace App\Models;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable=[

        'user_id',
        'review',
        'rating',
        'agency_id'
    ];

    protected $table='reviews';

    public function agency():BelongsTo{

        return $this->belongsTo(Agency::class);
    }
}
