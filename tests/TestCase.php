<?php

abstract class TestCase extends Orchestra\Testbench\TestCase {

    protected function getPackageProviders($app)
    {
        return ['Cupona\Providers\ContextServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('cupona.context', [
            'default'   => 'default',
            'namespace' => '\\Contextual\\Providers\\',
            'matcher'   => '{ClassName}ServiceProvider'
        ]);
    }

}
