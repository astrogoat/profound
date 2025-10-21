<?php

namespace Astrogoat\Profound;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Profound\Profound
 */
class ProfoundFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Profound::class;
    }
}
