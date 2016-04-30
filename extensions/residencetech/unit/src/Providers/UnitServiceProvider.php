<?php namespace Residencetech\Unit\Providers;

use Cartalyst\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		$this->app['events']->subscribe('residencetech.unit.unit.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Unit
		$this->bindIf('residencetech.unit.unit', 'Residencetech\Unit\Repositories\Unit\UnitRepository');
		$this->bindIf('residencetech.unit.unit.handler.event', 'Residencetech\Unit\Handlers\Unit\UnitEventHandler');
		$this->bindIf('residencetech.unit.unit.validator', 'Residencetech\Unit\Validator\Unit\UnitValidator');
	}

}
