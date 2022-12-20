<?php

namespace App\Models;

use App\Models\Agency;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable=[
        'hours'
    ];


    public function travels():HasMany
    {
        return $this->hasMany(Travel::class);
    }
}
