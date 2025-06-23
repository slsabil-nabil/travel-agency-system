<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'booking_id',
        'amount',
        'invoice_date',
        'status',
    ];

    /**
     * علاقة الفاتورة بالوكالة.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    /**
     * علاقة الفاتورة بالحجز (إن وُجد).
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
