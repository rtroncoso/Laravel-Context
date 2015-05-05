<?php

abstract class TestCase extends Orchestra\Testbench\TestCase {

    public function __setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return ['Cupona\Providers\ContextServiceProvider'];
    }


}
