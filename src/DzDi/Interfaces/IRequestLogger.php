<?php

namespace App\DzDi\Interfaces;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

interface IRequestLogger
{
    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @throws InvalidArgumentException
     * @throws ClientExceptionInterface
     * @return ResponseInterface
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface;
}
