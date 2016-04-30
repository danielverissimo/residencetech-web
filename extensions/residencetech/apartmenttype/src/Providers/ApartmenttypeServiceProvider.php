<?php namespace Residencetech\Apartmenttype\Providers;

use Cartalyst\Support\ServiceProvider;

class ApartmenttypeServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		$this->app['events']->subscribe('residencetech.apartmenttype.apartmenttype.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Apartmenttype
		$this->bindIf('residencetech.apartmenttype.apartmenttype', 'Residencetech\Apartmenttype\Repositories\Apartmenttype\ApartmenttypeRepository');
		$this->bindIf('residencetech.apartmenttype.apartmenttype.handler.event', 'Residencetech\Apartmenttype\Handlers\Apartmenttype\ApartmenttypeEventHandler');
		$this->bindIf('residencetech.apartmenttype.apartmenttype.validator', 'Residencetech\Apartmenttype\Validator\Apartmenttype\ApartmenttypeValidator');
	}

}
