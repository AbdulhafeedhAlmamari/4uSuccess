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
        'total_paid',
        'finance_type',
        'is_agreed',
        'terms_and_conditions',
        'status',
        'reply',
        'iban',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'total_paid' => 'decimal:2',
        'is_agreed' => 'boolean',
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

    /**
     * Get the installments for the finance request.
     */
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }

    /**
     * Get the remaining amount to be paid.
     */
    public function getRemainingAmountAttribute()
    {
        return $this->amount - $this->total_paid;
    }

    /**
     * Get the payment progress as a percentage.
     */
    public function getPaymentProgressAttribute()
    {
        if ($this->amount <= 0) {
            return 100;
        }

        return min(100, round(($this->total_paid / $this->amount) * 100));
    }

    /**
     * Get the paid installments count.
     */
    public function getPaidInstallmentsCountAttribute()
    {
        return $this->installments()->where('status', 'paid')->count();
    }
}
