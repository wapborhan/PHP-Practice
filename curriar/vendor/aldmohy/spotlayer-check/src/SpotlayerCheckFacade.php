<?php

namespace Aldmohy\SpotlayerCheck;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Aldmohy\SpotlayerCheck\Skeleton\SkeletonClass
 */
class SpotlayerCheckFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'spotlayer-check';
    }
}
