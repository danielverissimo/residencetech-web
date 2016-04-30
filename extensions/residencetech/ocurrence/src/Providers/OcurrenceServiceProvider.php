<?php namespace Residencetech\Ocurrence\Providers;

use Cartalyst\Support\ServiceProvider;

class OcurrenceServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		$this->app['events']->subscribe('residencetech.ocurrence.ocurrence.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Ocurrence
		$this->bindIf('residencetech.ocurrence.ocurrence', 'Residencetech\Ocurrence\Repositories\Ocurrence\OcurrenceRepository');
		$this->bindIf('residencetech.ocurrence.ocurrence.handler.event', 'Residencetech\Ocurrence\Handlers\Ocurrence\OcurrenceEventHandler');
		$this->bindIf('residencetech.ocurrence.ocurrence.validator', 'Residencetech\Ocurrence\Validator\Ocurrence\OcurrenceValidator');

		$this->bindIf('residencetech.ocurrence.reply', 'Residencetech\Ocurrence\Repositories\Ocurrence\ReplyRepository');
	}

}
