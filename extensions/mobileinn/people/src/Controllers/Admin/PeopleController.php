<?php namespace Mobileinn\People\Controllers\Admin;

use Mobileinn\People\Models\Person;
use Mobileinn\People\Repositories\Person\PersonRepositoryInterface;
use Mobileinn\Users\Models\User;
use Platform\Access\Controllers\AdminController;
use Firework\Common\Controllers\CrudTrait;
use Platform\Users\Repositories\UserRepositoryInterface;
use Residencetech\Apartmentcomplex\Repositories\Apartmentcomplex\ApartmentcomplexRepositoryInterface;
use Residencetech\Apartmentcomplex\Models\Apartmentcomplex;
use Input, Response, Auth;

class PeopleController extends AdminController {

	use CrudTrait
	{
		showForm as showFormTrait;
		processForm as processFormTrait;
	}

	protected $csrfWhitelist = [
		'executeAction',
	];

	protected $columns = [
		'name',
		'gender',
		'cpf',
		'telephone',
	];

	protected $settings = [
		'sort'      => 'id',
		'direction' => 'asc',
	];

	protected $actions = [
		'delete',
	];

	protected $langPrefix = 'mobileinn/people::people/';

	protected $viewPrefix = 'mobileinn/people::people/';

	protected $uri = 'people/people';

	protected $route = 'admin.mobileinn.people.people';

	protected $users;

	public function __construct(PersonRepositoryInterface $items, ApartmentcomplexRepositoryInterface $apartmentComplexes, UserRepositoryInterface $users)
	{
		parent::__construct();
		$this->items          = $items;
		$this->apartmentComplexes    = $apartmentComplexes;
		$this->users = $users;
	}

	protected function showForm($mode, $id = null)
	{

		$item = null;
		if ( ! is_null($id)) {
			$item = $this->items->find($id);
		} else {
			$item = $this->items->createModel();
		}

		$allApartmentComplex = Input::old('apartmentComplexes');
		if ($allApartmentComplex) {
			foreach ($allApartmentComplex as $key => $value) {
				$allApartmentComplex[$key] = $this->apartmentComplexes->find($value);
			}
		} else {
			$allApartmentComplex = $item->exists ? $item->apartmentComplexes : array();
		}

		if ( $user = $item->user()->first() ) {
			// Prepare the user permissions
			$permissions = request()->old('permissions', $user->permissions);

			if ( $data = $this->users->getPreparedUser($user->id) ) {

				$userRoles = $data['userRoles'];

			}else{
				$userRoles = array();
			}


		}else{
			$permissions = array();
			$userRoles = array();
			$roles = array();
		}

		$data = $this->users->getPreparedUser(null);

		// Get all the available roles
		$roles = $data['roles'];

		$this->extraVars(compact('allApartmentComplex', 'permissions', 'roles', 'userRoles'));

		return $this->showFormTrait($mode, $id);
	}

	public function search()
	{
		$query = Input::get('q');
		$people = $this->items->findByQuery($query);
		return Response::json($people);
	}

	public function findPeopleOnComplex()
	{
		$people = Person::whereHas('apartmentComplexes', function($q)
		{
			$query = Input::get('q');
			$q->where('people.name', 'LIKE', '%'.$query.'%');

		})->get();

		return Response::json($people);
	}
}
