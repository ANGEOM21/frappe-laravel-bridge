<?php

namespace Angeom\FrappeBridge\Facades;

use Illuminate\Support\Facades\Facade;

class Frappe extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'frappe';
    }
}
