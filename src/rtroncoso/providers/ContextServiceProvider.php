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
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->mergeConfigFrom([
			__DIR__.'/../../config/cupona.context.php' => config_path('cupona.context.php'),
		], 'cupona.context');

		$this->app->bind('context', 'Cupona\\Libraries\\Context');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
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
