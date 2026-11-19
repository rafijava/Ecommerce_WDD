<?php

namespace App\Services;

class EmsShippingService
{
    private array $rates = [
        'Dhaka' => 60.00,
        'Chattogram' => 120.00,
        'Khulna' => 120.00,
        'Rajshahi' => 120.00,
        'Barisal' => 140.00,
        'Sylhet' => 140.00,
        'Rangpur' => 140.00,
        'Mymensingh' => 140.00,
    ];

    public function rateFor(string $division): float
    {
        return $this->rates[$division] ?? 150.00;
    }

    public function defaultRate(): float
    {
        return 150.00;
    }

    public function divisions(): array
    {
        return array_keys($this->rates);
    }
}
