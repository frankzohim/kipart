<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Path extends Model
{
    use HasFactory;

    protected $fillable=[
        'departure',
        'arrival',
        'state',
    ];

    public function agencies():BelongsToMany
    {
        return $this->belongsToMany(Agency::class);
    }


}
