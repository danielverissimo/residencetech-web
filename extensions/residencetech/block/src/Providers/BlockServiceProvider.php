<?php namespace Residencetech\Block\Providers;

use Cartalyst\Support\ServiceProvider;

class BlockServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Subscribe the registered event handler
		$this->app['events']->subscribe('residencetech.block.block.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Block
		$this->bindIf('residencetech.block.block', 'Residencetech\Block\Repositories\Block\BlockRepository');
		$this->bindIf('residencetech.block.block.handler.event', 'Residencetech\Block\Handlers\Block\BlockEventHandler');
		$this->bindIf('residencetech.block.block.validator', 'Residencetech\Block\Validator\Block\BlockValidator');
	}

}
