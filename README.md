Laravel Context
===============

[![Total Downloads](https://poser.pugx.org/rtroncoso/laravel-context/d/total.svg)](https://packagist.org/packages/rtroncoso/laravel-context)
[![Build Status](https://travis-ci.org/rtroncoso/Laravel-Context.svg?branch=master)](https://travis-ci.org/rtroncoso/Laravel-Context)
[![License](https://poser.pugx.org/rtroncoso/laravel-context/license.svg)](https://packagist.org/packages/rtroncoso/laravel-context)

This simple yet powerful package will help you load different Service Providers depending in which context you are. Contexts can be setup using `context` middleware in your route groups or the `Context` facade.

It supports both **Laravel 5.1.x** _(release: ^2.0.0)_  and **Laravel 5.0.x** _(release: ^1.0.0)_

## What's it for?
Let's say you have 2 contexts in your application: an **Administration Panel** and a **RESTful WebService**. This are certainly two completely different contexts as in one context you'll maybe want to get all resources (i.e. including trashed) and in the other one you want only the active ones.

This is when Service Providers come in really handy, the only problem is that Laravel doesn't come with an out of the box solution for loading different Service Providers for different contexts.

This package gives you the possibility to register your different repositories to a single interface and bind them through your Context's Service Provider, using Laravel's amazing IoC Container to resolve which concrete implementation we need to bind depending on which context we are on.

## Installation Instructions
To install this package you'll simply need to add this line to your composer.json file:

### Laravel 5.0.x
```
"require": {
    "rtroncoso/laravel-context": "^1.0.0"
}
```

### Laravel 5.1.x
```
"require": {
    "rtroncoso/laravel-context": "^2.0.0"
}
```

After the installation is done, you need to add some stuff to `config/app.php`:

At the end of your `providers` array add the following:
   
```php
'providers' => [
    ...
    'Cupona\Providers\ContextServiceProvider',
]
```

At the end of your `aliases` array add the following:
  
```php
'aliases' => [
    ...
    'Cupona\Facades\Context',
]
```

Then you need to add the context middleware the `$routeMiddleware` array in your `App/Http/Kernel.php` file:
 
 ```php
  protected $routeMiddleware => [
      ...
      'context' => 'Cupona\Middleware\ContextMiddleware',
  ]
```
  
And last but not least, run this command to publish context configuration file:

    $ php artisan vendor:publish --provider="Cupona\Providers\ContextServiceProvider" --tag="config"

## Package Usage
So, here's the fun part! You have two ways of using this package, you can either load different contexts through `routes/route groups actions` or you can use the `Context` facade.

### Routes & Route Groups
Given the case you want your contexts to be loaded depending on which route or route group you are, you'll simply have to state which context you'll need to load in your `routes.php` file and create your Service Provider.

Let's see an example, if you want your `/admin` routes to load the `backend` context, you'll need to set up your `routes.php` file like this:

#### Laravel 5.1.x:
```php
Route::group(['prefix' => 'admin', 'middleware' => 'context:backend', function() {
    
    // Your contextually loaded routes go here
    
}]); 
```

#### Laravel 5.0.x:
```php
Route::group(['prefix' => 'admin', 'middleware' => 'context', 'context' => 'backend', function() {
    
    // Your contextually loaded routes go here
    
}]); 
```

And your `BackendServiceProvider` should look something like this:

```php
<?php namespace Contextual\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Your\\Interfaces\\UserRepositoryInterface', 'Your\\Repositories\\Backend\\UserRepository');
        
        // Make more awesome bindings here!
    }
    
}
```

By doing this you've defined your very own contexts in your application, this can be very helpful as you can make sure that when you are in an end user context **they will never** see your resources as in an administration context.

>Note: By default the backend context Service Provider will be loaded in the namespace `Contextual\Providers`, you can edit this in the configuration file provided by this package (`config/context.php`)

### Context Facade
If you want you can use this package's `Context` facade and dinamycally load and check which context you are in.

#### Loading a Context
```php
    Context::load('context');
```

#### Checking currently loaded Context
```php
    $currentContext = Context::current();
```
