<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'financing_company_id',
        'student_id',
        'description',
        'amount',
        'installment_period',
        'finance_type',
        'is_agreed',
        'terms_and_conditions',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_agreed' => 'boolean',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the financing company that owns the finance request.
     */
    public function financingCompany()
    {
        return $this->belongsTo(User::class, 'financing_company_id');
    }

    /**
     * Get the student that owns the finance request.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
