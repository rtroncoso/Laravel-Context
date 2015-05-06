<?php namespace Cupona\Libraries;

use Cupona\Services\NamespaceBuilder;
use Illuminate\Foundation\Application;
use ReflectionClass;

/**
 * Class Context
 * @property Application app
 * @property NamespaceBuilder builder
 * @package Cupona\Libraries
 */
class Context
{

    /**
     * Saves our current context for static facades
     * @var
     */
    protected $current;

    /**
     * @param Application $app
     * @param NamespaceBuilder $builder
     */
    public function __construct(Application $app, NamespaceBuilder $builder)
    {
        $this->app = $app;
        $this->builder = $builder;
    }

    /**
     * Loads a service provider depending on the context passed
     * to this method
     *
     * @param mixed $context
     * @param mixed $namespace
     * @param null $matcher
     * @return \Illuminate\Support\ServiceProvider
     */
    public function load($context = null, $namespace = null, $matcher = null)
    {
        if(is_null($context)) {
            $context = $this->app['config']['cupona.context.default'];
        }

        if(is_null($namespace)) {
            $namespace = $this->app['config']['cupona.context.namespace'];
        }

        if(is_null($matcher)) {
            $matcher = $this->app['config']['cupona.context.matcher'];
        }

        $provider = $this->builder->build($context, $namespace, $matcher);

        return $this->isValidProvider($provider) ? $this->app->register($provider) : null;
    }

    /**
     * Will check if the provider given is instantiable,
     * if not it will throw ReflectionException
     *
     * @param $provider
     * @return ReflectionClass
     * @throws \ReflectionException
     */
    private function isValidProvider($provider)
    {
        return new ReflectionClass($provider);
    }

}
