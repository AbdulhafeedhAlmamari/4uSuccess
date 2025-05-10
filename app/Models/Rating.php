<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = [
        'student_id',
        'housing_id',
        'consultant_id',
        'value',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
