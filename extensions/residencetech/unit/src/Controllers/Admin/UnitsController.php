<?php namespace Residencetech\Unit\Controllers\Admin;

use Mobileinn\People\Models\Person;
use Platform\Access\Controllers\AdminController;
use Firework\Common\Controllers\CrudTrait;
use Residencetech\Block\Repositories\Block\BlockRepositoryInterface;
use Residencetech\Unit\Models\Unit;
use Residencetech\Unit\Repositories\Unit\UnitRepositoryInterface;
Use Session;

class UnitsController extends AdminController {

	use CrudTrait{
		showForm as showFormTrait;
	}

	protected $csrfWhitelist = [
		'executeAction',
	];

	protected $columns = [
		'units.name' => 'name',
		'people.name' => 'owner_id',
		'blocks.name' => 'block_id',
		'units.created_at' => 'created_at',
	];

	protected $columnsExtra = [
		'units.id' => 'id',
	];


	protected $settings = [
		'sort'      => 'id',
		'direction' => 'asc',
	];

	protected $actions = [
		'delete',
	];

	protected $langPrefix = 'residencetech/unit::units/';

	protected $viewPrefix = 'residencetech/unit::units/';

	protected $uri = 'unit/units';

	protected $route = 'admin.residencetech.unit.units';

	protected $blocks;

	public function __construct(UnitRepositoryInterface $items, BlockRepositoryInterface $blockRepositoryInterface){

		parent::__construct();
		$this->items = $items;
		$this->blocks = $blockRepositoryInterface;
	}


	protected function showForm($mode, $id = null)
	{

		$apartmentComplexId = Session::get('current_apartmentcomplex.id');

		$owner = null;
		if ( $id ) {
			$owner = Unit::find($id)->owner;
		}

		$blocks = $this->blocks->findAllByApartmentComplex($apartmentComplexId);
		$this->extraVars(compact('blocks', 'owner'));

		return $this->showFormTrait($mode, $id);
	}
}
