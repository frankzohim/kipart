<?php

namespace App\Models;

use App\Models\Droit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'libelle',
        'etat'
    ];

    public function droits():BelongsToMany
    {
        return $this->belongsToMany(Droit::class);
    }


}
