<?php

abstract class TestCase extends Orchestra\Testbench\TestCase {

    public function __setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders()
    {
        return ['Cupona\Providers\ContextServiceProvider'];
    }

}
