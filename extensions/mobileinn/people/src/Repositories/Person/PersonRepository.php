<?php namespace Mobileinn\People\Repositories\Person;

use Firework\Common\Repositories\CrudTrait;
use Firework\Common\Repositories\HasOneTrait;
use Firework\Common\Repositories\BelongsToManyTrait;
use DB, Session;
use Mobileinn\People\Models\Person;
use Sentinel;

class PersonRepository implements PersonRepositoryInterface {

	use BelongsToManyTrait;

	use CrudTrait, HasOneTrait
	{
		create as createTrait;
		update as updateTrait;
		delete as deleteTrait;
	}

	protected $query;
	protected $userReturn;

	public function bootPersonRepository()
	{
		$this->address   = app('mobileinn.people.address');
		$this->cities    = app('firework.locations.city');
		$this->states    = app('firework.locations.state');
		$this->countries = app('firework.locations.country');
		$this->users = app('platform.users');

		$this->addAfterSaveCallbacks('setPermissions');

		$this->apartmentComplexes = app('residencetech.apartmentcomplex.apartmentcomplex');
		$this->belongsToManyRelations[] = 'apartmentComplexes';

		$this->hasOneRelations[] = 'address';
	}

	public function create(array $data)
	{
		list($message, $user) = $this->setUser($data);

		$data['user_id'] = $user->id;

		// Get the user roles
		$roles = array_get($data, 'roles', []);

		// Attach the user roles
		if ( ! empty($roles)) $user->roles()->attach($roles);

		$model = $this->createTrait($data);

		return $model;
	}

	public function update($id, array $input)
	{
		$p = [];

		if ( !empty($input['password_confirmation']) ){
			$p['password'] = $input['password_confirmation'];
		}

		$user = $this->find($id)->user;

		if ( isset($input['email']) && strcmp($user->email, $input['email']) != 0 ){
			$p['email'] = $input['email'];
		}

		if ( isset($input['name']) && strcmp($user->first_name . ' ' . $user->last_name, $input['name']) != 0 ){

		    $fullname = trim($input['name']); // remove double space
		    $p['first_name'] = substr($fullname, 0, strpos($fullname, ' '));
		    $p['last_name'] = substr($fullname, strpos($fullname, ' '), strlen($fullname));

		}

		Sentinel::update($user, $p);

		// Get the new user roles
		if ($roles = array_get($input, 'roles'))
		{
			// Get the user roles
			$userRoles = $user->roles->lists('id');

			// Prepare the roles to be added and removed
			$toAdd = array_diff($roles, $userRoles);
			$toDel = array_diff($userRoles, $roles);

			// Detach the user roles
			if ( ! empty($toDel)) $user->roles()->detach($toDel);

			// Attach the user roles
			if ( ! empty($toAdd)) $user->roles()->attach($toAdd);
		}else{

			// Get the user roles
			$userRoles = $user->roles->lists('id');

			// Detach the user roles
			$user->roles()->detach($userRoles);
		}

		return $this->updateTrait($id, $input);
	}

	public function delete($id)
	{

		$user = $this->find($id)->user;

		$traitReturn = $this->deleteTrait($id);

		$this->users->delete($user->id);

		return $traitReturn;
	}

	public function getPreparedItem($id, $mode)
	{
		$data = $this->getPreparedItemTrait($id, $mode);

		$countries = $this->countries->findAll();
		$states    = [];
		$cities    = [];

		if (eloquent_get($data['item'], 'address'))
		{
			$states = $this->states->getByCountryIdOrCode($data['item']->address->country->id);
			$cities = $this->cities->getByStateIdOrCode($data['item']->address->state->id);
		}

		if (old('address.country_id'))
		{
			$states = $this->states->getByCountryIdOrCode(old('address.country_id'));
		}

		if (old('address.state_id'))
		{
			$cities = $this->cities->getByStateIdOrCode(old('address.state_id'));
		}

		$data['countries'] = $countries;
		$data['states']    = $states;
		$data['cities']    = $cities;

		return $data;
	}

	public function validForUpdate($data, array $input)
	{
		$bindings = [
			'email' => $data->email,
		];

		return $this->validator->on('update')->bind($bindings)->validate($input);
	}

	public function setUser($data)
	{
		$input = [
			'activated'  => true,
			'first_name' => $data['name'],
			'last_name'  => $data['name'],
			'email'      => $data['email'],
			'password'   => $data['password_confirmation'],
			'password_confirmation' => $data['password_confirmation'],
		];

		$this->userReturn = $this->users->create($input);

		/*
		if ( strcmp($mode, "update") == 0 ) {
			$userId = $model->user->id;
		}else{
			$userId = $this->userReturn[1]->id;
		}

		$model->user_id = $userId;
		$model->update();

		return $model;
		*/

		return $this->userReturn;
	}

	public function setPermissions($model, $data, $mode)
	{
		$permissions = $data['permissions'];

		$u = array(
			"permissions" => $permissions
		);

		if ( strcmp($mode, "update") == 0 ) {
			$this->users->update($model->user->id, $u);
		}else{
			$userId = $this->userReturn[1]->id;
			$this->users->update($userId, $u);
		}
	}

	public function findByQuery($query)
	{
		$model = $this->createModel();
		$people = $model->getTable();

		return DB::table($people)
			->select(DB::raw($people . ".id," . $people . ".name"))
			->where($people . ".name", 'LIKE', '%'.$query.'%')
			->get();
	}

	public function grid()
	{
		$model = $this->createModel();
		$people = $model->getTable();
		$apartmentComplex = $model->apartmentComplexes()->getRelated()->getTable();

		return $this->createModel()
			->select(
				$people.'.*'
			)
			->join('apartmentcomplex_person', function ($join) {

				// Return only people with access in Apartment Complexes
				$apartmentComplexId = Session::get('current_apartmentcomplex.id');

				$join->on('apartmentcomplex_person.person_id', '=', 'people.id')
					->where('apartmentcomplex_person.apartmentcomplex_id', '=', $apartmentComplexId);
			});
	}
}
