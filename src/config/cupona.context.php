<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Service Provider
    |--------------------------------------------------------------------------
    |
    | This will set the default provider to register when
    | we try to load a service provider with no context
    | specified
    |
    */
    'default' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Default Namespace
    |--------------------------------------------------------------------------
    |
    | Sets the default namespace in which the library will search for
    | your service providers
    |
    */
    'namespace' => 'Contextual\\Providers',

    /*
    |--------------------------------------------------------------------------
    | Matcher
    |--------------------------------------------------------------------------
    |
    | Sets the matcher to be used by the NamespaceBuilder. It will
    | search for any {ClassName} matches and replace them with the
    | passed context (converting your context into PSR-1 StudlyCaps)
    |
    */
    'matcher' => '{ClassName}ServiceProvider',

    /*
    |--------------------------------------------------------------------------
    | Custom Service Providers
    |--------------------------------------------------------------------------
    |
    | Here you can preload all your custom service providers, given
    | a key-value pair for each one of them (context => concrete)
    |
    */
    'custom' => [
        'test' => 'Contextual\\Providers\\TestServiceProvider',
    ]

];