<?php

namespace App\Models;

use App\Models\Path;
use App\Models\Codeqr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory;

    protected $fillable=[
        'date',
        'path_id',
        'agency_id',
        'price',
        'state',
        'class'
    ];

    public function codeqr():BelongsTo
    {
        return $this->belongsTo(Codeqr::class);
    }

    public function agency():BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function paiements():HasMany

    {
        return $this->hasMany(Paiement::class);
    }

    public function path():BelongsTo
    {
        return $this->belongsTo(Path::class);
    }
}
