<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Agency;
use App\Models\Codeqr;
use App\Models\Ticket;
use App\Models\Notification;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'isVerifiedOtp',
        'password',
        'phone_number',
        'brand_ambassadors_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notifications():HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function codeqr():BelongsTo
    {
        return $this->belongsTo(Codeqr::class);
    }

    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function paiements():HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    public function agencies():HasMany
    {
        return $this->hasMany(Agency::class);
    }

    public function tickets():HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function findForPassport($username) {
        return $this->where('phone_number','=', $username)->first();
    }
}
