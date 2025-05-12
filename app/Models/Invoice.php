<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable  = [
        'reservation_request_id',
        'installment_id',
        'user_id',
        'type_invoice',
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
    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }
}
