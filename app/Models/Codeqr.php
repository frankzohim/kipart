<?php

namespace App\Models;

use App\Models\User;
use App\Models\Token;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Codeqr extends Model
{
    use HasFactory;

    protected $fillable=[
        'uuid',
        'user_id',
        'travel_id',
        'isVerified',

    ];

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function travels():HasMany
    {
        return $this->hasMany(Travel::class);
    }

    public function tokens():HasMany
    {
        return $this->hasMany(Token::class);
    }
}
