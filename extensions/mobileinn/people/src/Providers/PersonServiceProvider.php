<?php namespace Mobileinn\People\Providers;

use Cartalyst\Support\ServiceProvider;

class PersonServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		$this->app['events']->subscribe('mobileinn.people.person.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		$this->prepareResources();

		// Person
		$this->bindIf('mobileinn.people.person', 'Mobileinn\People\Repositories\Person\PersonRepository');
		$this->bindIf('mobileinn.people.person.document.repository', 'Mobileinn\People\Repositories\Person\DocumentRepository');
		$this->bindIf('mobileinn.people.person.documenttype.repository', 'Mobileinn\People\Repositories\Person\DocumentTypeRepository');
		$this->bindIf('mobileinn.people.person.handler.event', 'Mobileinn\People\Handlers\Person\PersonEventHandler');
		$this->bindIf('mobileinn.people.person.validator', 'Mobileinn\People\Validator\Person\PersonValidator');
	}

	/**
	 * Prepare the package resources.
	 *
	 * @return void
	 */
	protected function prepareResources()
	{
		$config = realpath(__DIR__.'/../../config/config.php');

		$this->mergeConfigFrom($config, 'mobileinn-person');

		$this->publishes([
			$config => config_path('mobileinn-person.php'),
		], 'config');
	}
}
