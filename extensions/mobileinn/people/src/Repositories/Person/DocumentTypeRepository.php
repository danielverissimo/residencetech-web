<?php namespace Mobileinn\People\Repositories\Person;

use Firework\Common\Repositories\CrudTrait;
use Config;

class DocumentTypeRepository implements DocumentTypeRepositoryInterface {
	use CrudTrait
	{
		delete as deleteTrait;
	}

	protected $rules = [
		'name' => 'required|unique'
	];

	public function grid(){

		$fieldToBlock = Config::get('mobileinn/people::people/general.cpf');

		$documentTypes = $this->findAll();
		foreach ($documentTypes as &$documentType) {
			$documentType->block_selection = ($documentType->name == $fieldToBlock);
		}

		return $documentTypes;
	}

	public function findByName($name)
	{
		$query = $this->createModel()->whereName($name);
		return $query->first();
	}

}
