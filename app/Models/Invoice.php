<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable  = [
        'reservation_request_id',
        'user_id',
        'status',
        'amount_invoice',
        'vat',
        'service_fee',
        'date_invoice'
    ];

    public function reservationRequest()
    {
        return $this->belongsTo(ReservationRequest::class);
    }
}
