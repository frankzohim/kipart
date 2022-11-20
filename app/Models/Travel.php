<?php

namespace App\Models;

use App\Models\Codeqr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory;

    protected $fillable=[
        'uuid',
        'date',
        'departure',
        'arrival'
    ];

    public function codeqr():BelongsTo
    {
        return $this->belongsTo(Codeqr::class);
    }
}
