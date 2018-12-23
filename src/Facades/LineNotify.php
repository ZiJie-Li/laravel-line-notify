<?php

namespace Royalmar\LineNotify\Facades;

use Illuminate\Support\Facades\Facade;

class LineNotify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LineNotify';
    }
}
