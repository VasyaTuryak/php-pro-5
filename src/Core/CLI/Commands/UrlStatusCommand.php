<?php

namespace App\Core\CLI\Commands;

use App\DzDi\Interfaces\IRequestLogger;

class UrlStatusCommand extends AbstractCommand
{
       const NAME = 'SiteStatus';

    public function __construct(protected IRequestLogger $status)
    {

    }

    public static function getCommandDesc(): string
    {
        return 'Home work VasyaT';
    }

    protected function runAction(): string
    {
        return $this->status->handle($this->params[0], $this->params[1]);
    }
}