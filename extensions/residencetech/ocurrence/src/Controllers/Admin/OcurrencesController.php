<?php namespace Residencetech\Ocurrence\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Firework\Common\Controllers\CrudTrait;
use Residencetech\Ocurrence\Repositories\Ocurrence\OcurrenceRepositoryInterface;
use Residencetech\Ocurrence\Repositories\Ocurrence\ReplyRepositoryInterface;
use Input, Session, Auth, Sentinel;
use Log;

class OcurrencesController extends AdminController {

	use CrudTrait{
		processForm as processFormTrait;
		showForm as showFormTrait;
	}

	protected $csrfWhitelist = [
		'executeAction',
	];

	protected $columns = [
		'ocurrences.id' => 'id',
			'ocurrences.data' => 'data',
			'ocurrences.updated_at' => 'updated_at',
			'people.name' => 'person_name',
	];

	protected $columnsExtra = [

	];

	protected $settings = [
		'sort'      => 'id',
		'direction' => 'asc',
	];

	protected $actions = [
		'delete',
	];

	protected $langPrefix = 'residencetech/ocurrence::ocurrences/';

	protected $viewPrefix = 'residencetech/ocurrence::ocurrences/';

	protected $uri = 'ocurrence/ocurrences';

	protected $route = 'admin.residencetech.ocurrence.ocurrences';

	protected $reply = null;

	public function __construct(OcurrenceRepositoryInterface $items, ReplyRepositoryInterface $reply)
	{
		parent::__construct();
		$this->items = $items;
		$this->reply = $reply;
	}

	public function showForm($mode, $id = null)
	{

		$ocurrence = $this->items->find($id);

		if ( $ocurrence ){
			$replies = $this->items->find($id)->replies()->orderBy('id', 'desc')->get();
			$this->extraVars(compact('replies'));
		}

		return $this->showFormTrait($mode, $id);
	}

	public function store()
	{
		$this->setApartmentComplex();
		$this->setPeople();

		return $this->processFormTrait('create');
	}

	public function close($id)	{

		return $this->items->close($id);
	}

	public function createReply()
	{
		$input = Input::all();
		$reply = $this->reply->createReply($input);

		return $reply[1];
	}

	public function update($id)
	{
		$this->setApartmentComplex();
		$this->setPeople();

		return $this->processFormTrait('update', $id);
	}

	private function setPeople(){

		$anonym = Input::get('anonym');

		if ( !$anonym ) {

			$user = Sentinel::getUser();
        	$personId = $user->person()->first()->id;

			Input::merge(array('person_id'=> $personId));
		}else{
			Input::merge(array('person_id'=> NULL));
		}

	}

	private function setApartmentComplex(){

		$apartmentComplexId = Session::get('current_apartmentcomplex.id');
		Input::merge(array('apartment_complex_id'=> $apartmentComplexId));

	}

}
