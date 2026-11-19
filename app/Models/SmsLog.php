<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_phone',
        'order_id',
        'total_amount',
        'message',
        'payload',
        'status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];
}
