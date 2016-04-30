<?php namespace Residencetech\Block\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Firework\Common\Controllers\CrudTrait;
use Session, Input;

class BlocksController extends AdminController {

	use CrudTrait{
		processForm as processFormTrait;
	}

	protected $csrfWhitelist = [
		'executeAction',
	];

	protected $columns = [
		'blocks.name' => 'name',
		'blocks.created_at' => 'created_at',
	];

	protected $columnsExtra = [
		'blocks.id' => 'id',
	];

	protected $settings = [
		'sort'      => 'id',
		'direction' => 'asc',
	];

	protected $actions = [
		'delete',
	];

	protected $langPrefix = 'residencetech/block::blocks/';

	protected $viewPrefix = 'residencetech/block::blocks/';

	protected $uri = 'block/blocks';

	protected $route = 'admin.residencetech.block.blocks';

	public function store()
	{
		$apartmentComplexId = Session::get('current_apartmentcomplex.id');
		Input::merge(array('apartment_complex_id'=> $apartmentComplexId));
		
		return $this->processFormTrait('create');
	}
}
