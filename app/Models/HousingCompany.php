<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousingCompany extends Model
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
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function housing()
    // {
    //     return $this->hasMany(Housing::class);
    // }
}
