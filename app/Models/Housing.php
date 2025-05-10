<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housing extends Model
{
    use HasFactory;

    protected $fillable = [
        'housing_company_id',
        'address',
        'description',
        'price',
        'housing_type',
        'rules',
        'distance_from_university',
        'features',
    ];

    protected $table = 'housing';

    /**
     * Get the housing company that owns the housing.
     */
    public function housingCompany()
    {
        return $this->belongsTo(User::class, 'housing_company_id');
    }

    /**
     * Get the photos for the housing.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Get the primary photo for the housing.
     */
    public function primaryPhoto()
    {
        return $this->hasOne(Photo::class)->where('is_primary', true);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function rate()
    {
        return $this->ratings->isNotEmpty() ? $this->ratings()->sum('value') / $this->ratings()->count() : 0;
    }
}
