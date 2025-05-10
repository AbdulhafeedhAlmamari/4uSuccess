<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function consultant()
    {
        return $this->hasOne(Consultant::class);
    }

    public function consultantRequests()
    {
        return $this->hasMany(ConsultationRequest::class, 'consultant_id');
    }

    public function financingCompany()
    {
        return $this->hasOne(FinancingCompany::class);
    }

    public function housingCompany()
    {
        return $this->hasOne(HousingCompany::class);
    }

    public function housing()
    {
        return $this->hasMany(Housing::class);
    }

    public function transportationCompany()
    {
        return $this->hasOne(TransportationCompany::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'student_id');
    }

    public function rated(Housing $housing)
    {
        return $this->ratings->where('housing_id', $housing->id)->isNotEmpty();
    }

    public function housingRatings(Housing $housing)
    {
        return $this->rated($housing) ? $this->ratings->where('housing_id', $housing->id)->first() : NULL;
    }
}
