<?php

namespace App\Models;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Horaire extends Model
{
    use HasFactory;

    protected $fillable=[
        'heure'
    ];

    public function agencies():BelongsToMany
    {
        return $this->belongsToMany(Agency::class);
    }
}
