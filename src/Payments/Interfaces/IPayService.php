<?php

namespace App\Payments\Interfaces;

use App\Payments\Exceptions\PayException;

interface IPayService
{
    /**
     * @param IOrder $order
     * @param callable|null $success
     * @param callable|null $error
     * @throws PayException
     * @return bool
     */
    public function pay(IOrder $order, ?callable $success = null, ?callable $error = null): bool;
}