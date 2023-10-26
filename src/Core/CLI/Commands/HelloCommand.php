<?php

namespace App\Core\CLI\Commands;

use App\Core\CLI\Interfaces\ICliCommand;

class HelloCommand implements ICliCommand
{

    /**
     * @inheritDoc
     */
    public static function getCommandName(): string
    {
        return 'hello';
    }

    /**
     * @inheritDoc
     */
    public static function getCommandDesc(): string
    {
        return 'Print hello';
    }

    /**
     * @inheritDoc
     */
    public function run(array $params = []): void
    {
        echo 'Hello, World' . PHP_EOL;
    }
}