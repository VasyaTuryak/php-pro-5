<?php

namespace App\DzDi;

use GuzzleHttp\ClientInterface;
use Monolog\Handler\HandlerInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * @property $params
 */
class UrlRequest implements Interfaces\IRequestLogger
{

    /**
     * @inheritDoc
     */

    public function __construct(
        protected ClientInterface $webRequest,
        protected Logger          $logger
    )
    {
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        return $this->webRequest->get($url);
    }

    public function handle($method, $url)
    {
        $status = $this->request($method, $url)->getStatusCode();
        $SizeKb = $this->request($method, $url)->getHeader('Content-Length')[0];
        $this->logger->pushHandler(new StreamHandler('php://stderr'));
        $this->logger->notice('INFO', ['Status: ', $status, 'Size: ', $SizeKb]);
        return 'Finish program, result from logger above';
    }
}