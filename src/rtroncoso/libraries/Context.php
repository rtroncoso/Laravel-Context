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
     * @var string
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
     * Gets the current context
     *
     * @return string
     */
    public function current()
    {
        return $this->current;
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

        return $this->build($context, $namespace, $matcher);
    }

    /**
     * Builds a provider string and loads it into our application
     *
     * @param $context
     * @param $namespace
     * @param $matcher
     * @return \Illuminate\Support\ServiceProvider|null
     */
    private function build($context, $namespace, $matcher)
    {
        // Save our current context
        $this->current = $context;

        $provider = $this->getPreloadedProvider($context) ?:
            $this->builder->build($this->current, $namespace, $matcher);

        return $this->validProvider($provider) ?
            $this->app->register($provider) : null;
    }

    /**
     * Gets a preloaded Service Provider from our config string
     * or else return null if not found
     *
     * @param $context
     * @return string
     */
    private function getPreloadedProvider($context)
    {

        $config = $this->app['config']['cupona.context.custom'];

        return array_key_exists($context, $config) ? $config[$context] : null;
    }

    /**
     * Will check if the provider given is instantiable,
     * if not it will throw ReflectionException
     *
     * @param $provider
     * @return ReflectionClass
     * @throws \ReflectionException
     */
    private function validProvider($provider)
    {
        return new ReflectionClass($provider);
    }

}
