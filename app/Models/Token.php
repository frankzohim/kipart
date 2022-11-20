<?php

namespace App\Models;

use App\Models\Codeqr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Token extends Model
{
    use HasFactory;

    protected $fillable=[
        'type',
        'path_token'
    ];

    public function codeqr():BelongsTo
    {
        return $this->belongsTo(Codeqr::class);
    }
}
