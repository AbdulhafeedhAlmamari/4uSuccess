<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'activity_type',
        'consultation_duration',
        'specialization',
        'identity_image',
        'certificate_image',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}