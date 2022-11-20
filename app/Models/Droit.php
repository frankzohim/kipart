<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Droit extends Model
{
    use HasFactory;

    protected $fillable=[
        'libelle'
    ];

    public function groups():BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }
}
