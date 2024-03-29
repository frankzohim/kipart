<?php

namespace App\Models;

use App\Models\Bus;
use App\Models\Path;
use App\Models\Codeqr;
use App\Models\Ticket;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Passenger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory;

    protected $fillable=[
        'date',
        'path_id',
        'bus_id',
        'price',
        'state',
        'classe',
        'schedule_id'
    ];

    protected $casts = [
        'date' => 'date:Y-m-d'
     ];


    public function codeqr():BelongsTo
    {
        return $this->belongsTo(Codeqr::class);
    }

    public function paiements():HasMany

    {
        return $this->hasMany(Payment::class);
    }

    public function path():BelongsTo
    {
        return $this->belongsTo(Path::class);
    }

    public function passengers():HasMany
    {
        return $this->hasMany(Passenger::class);
    }

    public function bus():BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
    public function schedule():BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function tickets():HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
