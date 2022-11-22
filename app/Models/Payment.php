<?php

namespace App\Models;

use App\Models\Path;
use App\Models\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'travel_id',
        'means_of_payment'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);;
    }

    public function path():BelongsTo
    {
        return $this->belongsTo(Path::class);
    }
}
