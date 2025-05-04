<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'finance_request_id',
        'user_id',
        'name',
        'amount',
        'due_date',
        'status',
        'payment_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'due_date' => 'date',
    ];

    /**
     * Get the finance request that owns the installment.
     */
    public function financeRequest()
    {
        return $this->belongsTo(FinanceRequest::class);
    }

    /**
     * Get the user that owns the installment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the installment is paid.
     */
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    /**
     * Check if the installment is overdue.
     */
    public function isOverdue()
    {
        return $this->status === 'overdue' ||
               ($this->status === 'unpaid' && $this->due_date < now());
    }

    /**
     * Update overdue status if needed.
     */
    public function updateOverdueStatus()
    {
        if ($this->status === 'unpaid' && $this->due_date < now()) {
            $this->update(['status' => 'overdue']);
        }
    }
}
