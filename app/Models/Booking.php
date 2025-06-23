<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'customer_name',
        'destination',
        'travel_date',
        'price',
    ];

    /**
     * علاقة الحجز بالوكالة.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
