<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setUp()
	{
		parent::setUp();

		$this->app['Illuminate\Contracts\Http\Kernel']->disableMiddleware();

		$this->setUpPlatform();
	}

	/**
	 * Setup platform.
	 */
	protected function setUpPlatform()
	{
		$this->app['config']->set('database.connections.sqlite.database', ':memory:');
		$this->app['config']->set('database.default', 'sqlite');

		// Installer instance
		$installer = $this->app['platform.installer'];

		// Get database config
		$config = $this->app['config']->get("database.connections.sqlite");

		$this->migrate();

		// Set database config
		$installer->setDatabaseData('sqlite', $config);

		// Migrate packages
		$installer->install(true);

		// Migrate application.
		$this->app['Illuminate\Contracts\Console\Kernel']->call('migrate', ['--env' => 'testing']);

		// Boot extensions
		$this->app['platform']->bootExtensions();
	}

	/**
	 * Resets the database and install the migration table.
	 *
	 * @return void
	 */
	protected function migrate()
	{
		$tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

		foreach ($tableNames as $table)
		{
			Schema::drop($table);
		}

		$this->app['Illuminate\Contracts\Console\Kernel']->call('migrate:install', ['--env' => 'testing']);
	}

}
