<?php namespace Cupona\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ContextServiceProvider
 * @package Cupona\Providers
 */
class ContextServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->publishes([
            __DIR__.'../../config/cupona.context.php' => config_path('cupona.context.php'),
        ]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
