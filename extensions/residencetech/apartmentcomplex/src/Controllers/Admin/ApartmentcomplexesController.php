<?php namespace Residencetech\Apartmentcomplex\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Firework\Common\Controllers\CrudTrait;
use Residencetech\Apartmentcomplex\Repositories\Apartmentcomplex\ApartmentcomplexRepository;
use Residencetech\Apartmentcomplex\Repositories\Apartmentcomplex\ApartmentcomplexRepositoryInterface;
use Residencetech\Apartmenttype\Repositories\Apartmenttype\ApartmenttypeRepositoryInterface;
use Input, Response, Session, Redirect, Lang;

class ApartmentcomplexesController extends AdminController {

	use CrudTrait
	{
		showForm as showFormTrait;
	}

	protected $csrfWhitelist = [
		'executeAction',
	];

	protected $columns = [
		'apartmentcomplexes.name' => 'name',
			'apartmenttypes.type' => 'type',
			'apartmenttypes.created_at' => 'created_at',
	];

	protected $columnsExtra = [
		'apartmentcomplexes.id' => 'id',
	];

	protected $settings = [
		'sort'      => 'id',
		'direction' => 'asc',
	];

	protected $actions = [
		'delete',
	];

	protected $langPrefix = 'residencetech/apartmentcomplex::apartmentcomplexes/';

	protected $viewPrefix = 'residencetech/apartmentcomplex::apartmentcomplexes/';

	protected $uri = 'apartmentcomplex/apartmentcomplexes';

	protected $route = 'admin.residencetech.apartmentcomplex.apartmentcomplexes';

	protected $apartmentTypes;

	public function __construct(ApartmentcomplexRepositoryInterface $items, ApartmenttypeRepositoryInterface $apartmenttypeRepositoryInterface){

		parent::__construct();
		$this->items = $items;
		$this->apartmentTypes = $apartmenttypeRepositoryInterface;
	}

	protected function showForm($mode, $id = null)
	{
		$apartmentTypes = $this->apartmentTypes->findAll();
		$this->extraVars(compact('apartmentTypes'));

		return $this->showFormTrait($mode, $id);
	}

	public function search()
	{
		$query = Input::get('q');
		$apartmentComplexes = $this->items->findByQuery($query);
		return Response::json($apartmentComplexes);
	}

	protected function change($id)
	{
		$currentApartmentComplex = $this->items->find($id);

		Session::put("current_apartmentcomplex.id", $currentApartmentComplex->id);
		Session::put("current_apartmentcomplex.name", $currentApartmentComplex->name);

		return redirect('/admin');
	}
}
