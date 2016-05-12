<?php

use Illuminate\Foundation\Application;
use Cartalyst\Extensions\ExtensionInterface;
use Cartalyst\Settings\Repository as Settings;
use Cartalyst\Permissions\Container as Permissions;

return [

	/*
	|--------------------------------------------------------------------------
	| Name
	|--------------------------------------------------------------------------
	|
	| This is your extension name and it is only required for
	| presentational purposes.
	|
	*/

	'name' => 'Ocurrence',

	/*
	|--------------------------------------------------------------------------
	| Slug
	|--------------------------------------------------------------------------
	|
	| This is your extension unique identifier and should not be changed as
	| it will be recognized as a new extension.
	|
	| Ideally, this should match the folder structure within the extensions
	| folder, but this is completely optional.
	|
	*/

	'slug' => 'residencetech/ocurrence',

	/*
	|--------------------------------------------------------------------------
	| Author
	|--------------------------------------------------------------------------
	|
	| Because everybody deserves credit for their work, right?
	|
	*/

	'author' => 'Daniel Eduardo',

	/*
	|--------------------------------------------------------------------------
	| Description
	|--------------------------------------------------------------------------
	|
	| One or two sentences describing the extension for users to view when
	| they are installing the extension.
	|
	*/

	'description' => 'Ocurrence',

	/*
	|--------------------------------------------------------------------------
	| Version
	|--------------------------------------------------------------------------
	|
	| Version should be a string that can be used with version_compare().
	| This is how the extensions versions are compared.
	|
	*/

	'version' => '0.1.0',

	/*
	|--------------------------------------------------------------------------
	| Requirements
	|--------------------------------------------------------------------------
	|
	| List here all the extensions that this extension requires to work.
	| This is used in conjunction with composer, so you should put the
	| same extension dependencies on your main composer.json require
	| key, so that they get resolved using composer, however you
	| can use without composer, at which point you'll have to
	| ensure that the required extensions are available.
	|
	*/

	'require' => [],

	/*
	|--------------------------------------------------------------------------
	| Autoload Logic
	|--------------------------------------------------------------------------
	|
	| You can define here your extension autoloading logic, it may either
	| be 'composer', 'platform' or a 'Closure'.
	|
	| If composer is defined, your composer.json file specifies the autoloading
	| logic.
	|
	| If platform is defined, your extension receives convetion autoloading
	| based on the Platform standards.
	|
	| If a Closure is defined, it should take two parameters as defined
	| bellow:
	|
	|	object \Composer\Autoload\ClassLoader      $loader
	|	object \Illuminate\Foundation\Application  $app
	|
	| Supported: "composer", "platform", "Closure"
	|
	*/

	'autoload' => 'composer',

	/*
	|--------------------------------------------------------------------------
	| Service Providers
	|--------------------------------------------------------------------------
	|
	| Define your extension service providers here. They will be dynamically
	| registered without having to include them in app/config/app.php.
	|
	*/

	'providers' => [

		'Residencetech\Ocurrence\Providers\OcurrenceServiceProvider',

	],

	/*
	|--------------------------------------------------------------------------
	| Routes
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| any custom routing logic here.
	|
	| The closure parameters are:
	|
	|	object \Cartalyst\Extensions\ExtensionInterface  $extension
	|	object \Illuminate\Foundation\Application        $app
	|
	*/

	'routes' => function(ExtensionInterface $extension, Application $app)
	{
		Route::group([
				'prefix'    => admin_uri().'/ocurrence/ocurrences',
				'namespace' => 'Residencetech\Ocurrence\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.residencetech.ocurrence.ocurrences.all', 'uses' => 'OcurrencesController@index']);
				Route::post('/', ['as' => 'admin.residencetech.ocurrence.ocurrences.all', 'uses' => 'OcurrencesController@executeAction']);

				Route::get('grid', ['as' => 'admin.residencetech.ocurrence.ocurrences.grid', 'uses' => 'OcurrencesController@grid']);

				Route::get('create' , ['as' => 'admin.residencetech.ocurrence.ocurrences.create', 'uses' => 'OcurrencesController@create']);
				Route::post('create', ['as' => 'admin.residencetech.ocurrence.ocurrences.create', 'uses' => 'OcurrencesController@store']);

				Route::post('create_reply', ['as' => 'admin.residencetech.ocurrence.ocurrences.create_reply', 'uses' => 'OcurrencesController@createReply']);

				Route::get('close/{id}', ['as' => 'admin.residencetech.ocurrence.ocurrences.close', 'uses' => 'OcurrencesController@close']);

				Route::get('{id}'   , ['as' => 'admin.residencetech.ocurrence.ocurrences.edit'  , 'uses' => 'OcurrencesController@edit']);
				Route::post('{id}'  , ['as' => 'admin.residencetech.ocurrence.ocurrences.edit'  , 'uses' => 'OcurrencesController@update']);

				Route::delete('{id}', ['as' => 'admin.residencetech.ocurrence.ocurrences.delete', 'uses' => 'OcurrencesController@delete']);

			});

		Route::group([
			'prefix'    => 'ocurrence/ocurrences',
			'namespace' => 'Residencetech\Ocurrence\Controllers\Frontend',
		], function()
		{
			Route::get('/', ['as' => 'residencetech.ocurrence.ocurrences.index', 'uses' => 'OcurrencesController@index']);
		});

		Route::group([
			'prefix'    => admin_uri().'/api/v1',
			'namespace' => 'Residencetech\Ocurrence\Controllers\Api\V1',
			'middleware' => 'verifyToken',
		], function()
		{
			Route::get('ocurrences', ['as' => 'api.v1.residencetech.ocurrences', 'uses' => 'OcurrencesController@listOcurrences']);

			Route::get('ocurrences/closed', ['as' => 'api.v1.residencetech.ocurrences.closed', 'uses' => 'OcurrencesController@listClosedOcurrences']);

			Route::post('ocurrences/create', ['as' => 'api.v1.residencetech.ocurrences.create', 'uses' => 'OcurrencesController@create']);

			Route::post('ocurrences/create_reply', ['as' => 'api.v1.residencetech.ocurrences.create_reply', 'uses' => 'OcurrencesController@createReply']);

			Route::post('ocurrences/update/{id}', ['as' => 'api.v1.residencetech.ocurrences.update', 'uses' => 'OcurrencesController@update']);

			Route::post('ocurrences/close/{id}', ['as' => 'api.v1.residencetech.ocurrences.close', 'uses' => 'OcurrencesController@close']);

			Route::delete('ocurrences/delete/{id}', ['as' => 'api.v1.residencetech.ocurrences.delete', 'uses' => 'OcurrencesController@delete']);

			Route::delete('ocurrences/deletemedia/{id}', ['as' => 'api.v1.residencetech.ocurrences.delete.media', 'uses' => 'OcurrencesController@deleteMedia']);

			Route::get('ocurrences/{id}', ['as' => 'api.v1.residencetech.ocurrences.edit', 'uses' => 'OcurrencesController@edit']);

			Route::post('ocurrences/upload', ['as' => 'api.v1.residencetech.ocurrences.upload', 'uses' => 'OcurrencesController@upload']);
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Database Seeds
	|--------------------------------------------------------------------------
	|
	| Platform provides a very simple way to seed your database with test
	| data using seed classes. All seed classes should be stored on the
	| `database/seeds` directory within your extension folder.
	|
	| The order you register your seed classes on the array below
	| matters, as they will be ran in the exact same order.
	|
	| The seeds array should follow the following structure:
	|
	|	Vendor\Namespace\Database\Seeds\FooSeeder
	|	Vendor\Namespace\Database\Seeds\BarSeeder
	|
	*/

	'seeds' => [

	],

	/*
	|--------------------------------------------------------------------------
	| Permissions
	|--------------------------------------------------------------------------
	|
	| Register here all the permissions that this extension has. These will
	| be shown in the user management area to build a graphical interface
	| where permissions can be selected to allow or deny user access.
	|
	| For detailed instructions on how to register the permissions, please
	| refer to the following url https://cartalyst.com/manual/permissions
	|
	*/

	'permissions' => function(Permissions $permissions)
	{
		$permissions->group('ocurrence', function($g)
		{
			$g->name = 'Ocurrences';

			$g->permission('ocurrence.index', function($p)
			{
				$p->label = trans('residencetech/ocurrence::ocurrences/permissions.index');

				$p->controller('Residencetech\Ocurrence\Controllers\Admin\OcurrencesController', 'index, grid');
			});

			$g->permission('ocurrence.create', function($p)
			{
				$p->label = trans('residencetech/ocurrence::ocurrences/permissions.create');

				$p->controller('Residencetech\Ocurrence\Controllers\Admin\OcurrencesController', 'create, store');
			});

			$g->permission('ocurrence.edit', function($p)
			{
				$p->label = trans('residencetech/ocurrence::ocurrences/permissions.edit');

				$p->controller('Residencetech\Ocurrence\Controllers\Admin\OcurrencesController', 'edit, update');
			});

			$g->permission('ocurrence.delete', function($p)
			{
				$p->label = trans('residencetech/ocurrence::ocurrences/permissions.delete');

				$p->controller('Residencetech\Ocurrence\Controllers\Admin\OcurrencesController', 'delete');
			});

			$g->permission('ocurrence.list_all', function($p)
			{
				$p->label = trans('residencetech/ocurrence::ocurrences/permissions.list_all');

			});

			$g->permission('ocurrence.create_reply', function($p)
			{
				$p->label = trans('residencetech/ocurrence::ocurrences/permissions.create_reply');

			});
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Widgets
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| all your custom widgets here. Of course, Platform will guess the
	| widget class for you, this is just for custom widgets or if you
	| do not wish to make a new class for a very small widget.
	|
	*/

	'widgets' => function()
	{

	},

	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	|
	| Register any settings for your extension. You can also configure
	| the namespace and group that a setting belongs to.
	|
	*/

	'settings' => function(Settings $settings, Application $app)
	{

	},

	/*
	|--------------------------------------------------------------------------
	| Menus
	|--------------------------------------------------------------------------
	|
	| You may specify the default various menu hierarchy for your extension.
	| You can provide a recursive array of menu children and their children.
	| These will be created upon installation, synchronized upon upgrading
	| and removed upon uninstallation.
	|
	| Menu children are automatically put at the end of the menu for extensions
	| installed through the Operations extension.
	|
	| The default order (for extensions installed initially) can be
	| found by editing app/config/platform.php.
	|
	*/

	'menus' => [

		'admin' => [
			[
				'slug' => 'admin-residencetech-ocurrence-ocurrence',
				'name' => 'Ocorrência',
				'class' => 'fa fa-pencil-square',
				'uri' => 'ocurrence/ocurrences',
				'regex' => '/:admin\/ocurrence\/ocurrence/i',
			],
		],
		'main' => [

		],
	],

];
