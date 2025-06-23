<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'type',
        'report_date',
        'data',
    ];

    /**
     * علاقة التقرير بالوكالة.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
