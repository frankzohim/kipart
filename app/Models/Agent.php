<?php

namespace App\Models;

use App\Models\SubAgency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'password',
        'sub_agency_id'
    ];

    public function subAgency():BelongsTo
    {
        return $this->belongsTo(SubAgency::class);
    }
}
