<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commercial_register_number',
        'phone_number',
        'identity_image',
        'commercial_register_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'transportation_company_id', 'user_id');
    }
}