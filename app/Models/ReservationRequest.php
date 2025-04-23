<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'housing_id',
        'trip_id',
        'reservation_type',
        'status',
        'reply',
        'request_date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function housing()
    {
        return $this->belongsTo(Housing::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
