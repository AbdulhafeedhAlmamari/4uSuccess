<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'university_number',
        'university_name',
        'student_address',
        'student_phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}