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

	'name' => 'Apartmenttype',

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

	'slug' => 'residencetech/apartmenttype',

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

	'description' => 'Apartment Type',

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

	'require' => [
		'firework/common',
	],

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

		'Residencetech\Apartmenttype\Providers\ApartmenttypeServiceProvider',

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
				'prefix'    => admin_uri().'/apartmenttype/apartmenttypes',
				'namespace' => 'Residencetech\Apartmenttype\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.all', 'uses' => 'ApartmenttypesController@index']);
				Route::post('/', ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.all', 'uses' => 'ApartmenttypesController@executeAction']);

				Route::get('grid', ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.grid', 'uses' => 'ApartmenttypesController@grid']);

				Route::get('create' , ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.create', 'uses' => 'ApartmenttypesController@create']);
				Route::post('create', ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.create', 'uses' => 'ApartmenttypesController@store']);

				Route::get('{id}'   , ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.edit'  , 'uses' => 'ApartmenttypesController@edit']);
				Route::post('{id}'  , ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.edit'  , 'uses' => 'ApartmenttypesController@update']);

				Route::delete('{id}', ['as' => 'admin.residencetech.apartmenttype.apartmenttypes.delete', 'uses' => 'ApartmenttypesController@delete']);
			});

		Route::group([
			'prefix'    => 'apartmenttype/apartmenttypes',
			'namespace' => 'Residencetech\Apartmenttype\Controllers\Frontend',
		], function()
		{
			Route::get('/', ['as' => 'residencetech.apartmenttype.apartmenttypes.index', 'uses' => 'ApartmenttypesController@index']);
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

		'Residencetech\Apartmenttype\Database\Seeds\ApartmenttypesTableSeeder',

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
		$permissions->group('apartmenttype', function($g)
		{
			$g->name = 'Apartmenttypes';

			$g->permission('apartmenttype.index', function($p)
			{
				$p->label = trans('residencetech/apartmenttype::apartmenttypes/permissions.index');

				$p->controller('Residencetech\Apartmenttype\Controllers\Admin\ApartmenttypesController', 'index, grid');
			});

			$g->permission('apartmenttype.create', function($p)
			{
				$p->label = trans('residencetech/apartmenttype::apartmenttypes/permissions.create');

				$p->controller('Residencetech\Apartmenttype\Controllers\Admin\ApartmenttypesController', 'create, store');
			});

			$g->permission('apartmenttype.edit', function($p)
			{
				$p->label = trans('residencetech/apartmenttype::apartmenttypes/permissions.edit');

				$p->controller('Residencetech\Apartmenttype\Controllers\Admin\ApartmenttypesController', 'edit, update');
			});

			$g->permission('apartmenttype.delete', function($p)
			{
				$p->label = trans('residencetech/apartmenttype::apartmenttypes/permissions.delete');

				$p->controller('Residencetech\Apartmenttype\Controllers\Admin\ApartmenttypesController', 'delete');
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
				'slug' => 'admin-residencetech-apartmenttype-apartmenttype',
				'name' => 'Tipo Apartamento',
				'class' => 'fa fa-building-o',
				'uri' => 'apartmenttype/apartmenttypes',
				'regex' => '/:admin\/apartmenttype\/apartmenttype/i',
			],
		],
		'main' => [

		],
	],

];
