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
        $app['config']->set('context', [
            'default'   => 'default',
            'matcher'   => 'Contextual\\Providers\\{ClassName}ServiceProvider',
            'custom' => [
                'test' => 'Contextual\\Providers\\DummyServiceProvider'
            ]
        ]);
    }

}
