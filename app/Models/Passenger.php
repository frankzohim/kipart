<?php

namespace App\Models;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'travel_id',
        'type',
        'seatNumber',
        'cni',
    ];

    public function travel():BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }
}
