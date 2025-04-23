<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transportation_company_id',
        'driver_name',
        'plate_number',
        'destination',
        'transport_type',
        'start',
        'end',
        'go_date',
        'back_date',
        'trip_type',
        'number_of_seats',
        'distance',
        'price',
        'image',
    ];

    /**
     * Get the transportation company associated with the trip.
     */
    public function transportationCompany()
    {
        return $this->belongsTo(User::class, 'transportation_company_id');
    }
    
}