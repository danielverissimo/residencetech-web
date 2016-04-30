<?php namespace Residencetech\Apartmentcomplex\Providers;

use Cartalyst\Support\ServiceProvider;

class ApartmentcomplexServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		$this->app['events']->subscribe('residencetech.apartmentcomplex.apartmentcomplex.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Apartmentcomplex
		$this->bindIf('residencetech.apartmentcomplex.apartmentcomplex', 'Residencetech\Apartmentcomplex\Repositories\Apartmentcomplex\ApartmentcomplexRepository');
		$this->bindIf('residencetech.apartmentcomplex.apartmentcomplex.handler.event', 'Residencetech\Apartmentcomplex\Handlers\Apartmentcomplex\ApartmentcomplexEventHandler');
		$this->bindIf('residencetech.apartmentcomplex.apartmentcomplex.validator', 'Residencetech\Apartmentcomplex\Validator\Apartmentcomplex\ApartmentcomplexValidator');
	}

}
