<?php

namespace App\Payments\Interfaces;

use App\Payments\Exceptions\RejectPaymentException;

interface IPaymentSystem
{
    /**
     * @param int $amount
     * @param array $context
     * @throws RejectPaymentException
     * @return bool
     */
    public function pay(int $amount, array $context = []): bool;
}