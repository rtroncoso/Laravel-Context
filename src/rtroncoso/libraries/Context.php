<?php namespace Cupona\Libraries;

use Illuminate\Foundation\Application;

/**
 * Class Context
 * @property Application app
 * @package Cupona\Libraries
 */
class Context
{
    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

}
