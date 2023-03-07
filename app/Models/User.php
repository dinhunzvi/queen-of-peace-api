<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'password',
    ];

    /**
     * patients created by user
     * @return HasMany
     */
    public function patients(): HasMany
    {
        return $this->hasMany( Patient::class );

    }

    /**
     * appointments created by user
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany( Appointment::class );

    }
}
