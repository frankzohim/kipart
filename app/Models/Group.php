<?php

namespace App\Models;

use App\Models\Duty;
use App\Models\Droit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'wording',
        'etat'
    ];

    public function duties():BelongsToMany
    {
        return $this->belongsToMany(Duty::class);
    }


}
