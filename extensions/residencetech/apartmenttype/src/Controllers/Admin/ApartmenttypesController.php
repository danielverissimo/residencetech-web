<?php namespace Residencetech\Apartmenttype\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Firework\Common\Controllers\CrudTrait;

class ApartmenttypesController extends AdminController {

	use CrudTrait;

	protected $csrfWhitelist = [
		'executeAction',
	];

	protected $columns = [
		'id',
			'type',
			'created_at',
	];

	protected $settings = [
		'sort'      => 'id',
		'direction' => 'asc',
	];

	protected $actions = [
		'delete',
	];

	protected $langPrefix = 'residencetech/apartmenttype::apartmenttypes/';

	protected $viewPrefix = 'residencetech/apartmenttype::apartmenttypes/';

	protected $uri = 'apartmenttype/apartmenttypes';

	protected $route = 'admin.residencetech.apartmenttype.apartmenttypes';

}
