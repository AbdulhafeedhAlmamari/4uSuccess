<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancingCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'commercial_register_number',
        'phone_number',
        'identity_image',
        'commercial_register_image',
        'description',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function financeRequests()
    {
        return $this->hasMany(FinanceRequest::class, 'financing_company_id', 'user_id');
    }
}
