<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Duty extends Model
{
    use HasFactory;

    protected $fillable=[
        'wording'
    ];

    public function groups():BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }
}
