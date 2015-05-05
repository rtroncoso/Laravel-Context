<?php

class TestCase extends Orchestra\Testbench\TestCase {

    protected function getPackageProviders()
    {
        return ['Cupona\Providers\ContextServiceProvider'];
    }

}
