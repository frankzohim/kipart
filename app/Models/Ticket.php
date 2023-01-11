<?php

namespace App\Models;

use App\Models\User;
use App\Models\Travel;
use App\Models\Passenger;
use App\Models\SubAgency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'sub_agency_id',
        'travel_id',
        'passenger_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subAgency():BelongsTo
    {
        return $this->belongsTo(SubAgency::class);
    }

    public function travel():BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    public function passenger():BelongsTo
    {
        return $this->belongsTo(Passenger::class);
    }
}
