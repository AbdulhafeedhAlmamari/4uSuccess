<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'housing_id',
        'path',
        'title',
        'description',
        'is_primary',
    ];

    /**
     * Get the housing that owns the photo.
     */
    public function housing()
    {
        return $this->belongsTo(Housing::class);
    }
}
