<?php namespace Mobileinn\People\Providers;

use Cartalyst\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		$this->app['events']->subscribe('mobileinn.people.address.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Address
		$this->bindIf('mobileinn.people.address', 'Mobileinn\People\Repositories\PeopleAddress\PeopleAddressRepository');
		$this->bindIf('mobileinn.people.address.handler.event', 'Mobileinn\People\Handlers\PeopleAddress\PeopleAddressEventHandler');
		$this->bindIf('mobileinn.people.address.validator', 'Mobileinn\People\Validator\PeopleAddress\PeopleAddressValidator');
	}

}
