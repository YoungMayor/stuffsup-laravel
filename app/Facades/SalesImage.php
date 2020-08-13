<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SalesImage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SalesImageLocal';
    }
}
