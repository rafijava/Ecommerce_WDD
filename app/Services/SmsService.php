<?php

namespace App\Services;

use App\Models\SmsLog;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function send(string $phone, int $orderId, float $amount, string $message): void
    {
        $payload = [
            'to' => $phone,
            'order_id' => $orderId,
            'total_amount' => number_format($amount, 2),
            'message' => $message,
            'gateway' => 'simulated',
            'timestamp' => now()->toDateTimeString(),
        ];

        Log::info('SMS simulation payload', $payload);

        SmsLog::create([
            'recipient_phone' => $phone,
            'order_id' => $orderId,
            'total_amount' => $amount,
            'message' => $message,
            'payload' => json_encode($payload),
            'status' => 'simulated',
        ]);
    }
}
