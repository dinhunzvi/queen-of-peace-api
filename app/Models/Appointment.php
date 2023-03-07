<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function patient(): BelongsTo
    {
        return $this->belongsTo( Patient::class );

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );

    }

    protected $casts = [
        'appointment_date'  => 'date'
    ];

}
