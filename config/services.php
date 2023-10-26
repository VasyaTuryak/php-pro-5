<?php

use App\Core\DI\Container;
use App\Core\DI\Enums\ServiceConfigArrayKeys as S;
use App\Core\DI\ValueObjects\ServiceObject;
use App\DzDi\UrlRequest;
use App\ORM\ActiveRecord\DatabaseAR;
use App\Shortener\DBRepository;
use App\Shortener\FileRepository;
use App\Shortener\Helpers\UrlValidator;
use App\Shortener\UrlConverter;
use GuzzleHttp\Client;
use Illuminate\Database\Capsule\Manager;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

return [
    Manager::class => [
        S::CLASSNAME => DatabaseAR::class,
        S::ARGUMENTS => [
            '%db.mysql.dbname',
            '%db.mysql.user',
            '%db.mysql.pass',
            '%db.mysql.host',
        ],
    ],


    "shortener.codeDBRepository" => [
        S::CLASSNAME => DBRepository::class,
    ],

    "shortener.converter" => [
        S::CLASSNAME => UrlConverter::class,
        S::ARGUMENTS => [
            '@shortener.codeDBRepository',
            '@shortener.urlValidator',
            '%urlConverter.codeLength',
        ],
    ],
    "Status.request" => [
        S::CLASSNAME => UrlRequest::class,
        S::ARGUMENTS => [
            '@guzzle.client',
            '@monolog.logger'
        ],
    ],

    "shortener.codeRepository" => [
        S::CLASSNAME => FileRepository::class,
        S::ARGUMENTS => [
            '%dbFile',
        ],
    ],
    "shortener.urlValidator" => [
        S::CLASSNAME => UrlValidator::class,
        S::ARGUMENTS => [
            '@guzzle.client',
        ],
    ],
    "guzzle.client" => [
        S::CLASSNAME => Client::class,
    ],
    "monolog.logger" => [
        S::CLASSNAME => Logger::class,
        S::ARGUMENTS => [
            '%monolog.channel',
        ],
        S::COMPILER => function (Container $container, object $object, ServiceObject $refs) {
            /**
             * @var Logger $object
             */
            foreach ($container->getByTag('monolog.stream') as $item) {
                $object->pushHandler($item);
            }
        },
    ],
    "monolog.streamHandler.info" => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.info',
            Level::Info,
        ],
        S::TAGS => ['monolog.stream'],
    ],
    "monolog.streamHandler.error" => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.error',
            Level::Error,
        ],
        S::TAGS => ['monolog.stream'],
    ],
    "monolog.streamHandler.debug" => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.debug',
            Level::Debug,
        ],
        S::TAGS => ['monolog.stream'],
    ],
    "monolog.streamHandler.notice" => [
        S::CLASSNAME => StreamHandler::class,
        S::ARGUMENTS => [
            '%monolog.level.notice',
            Level::Notice,
        ],
        S::TAGS => ['monolog.stream'],
    ],

];