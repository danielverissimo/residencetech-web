<?php namespace Mobileinn\People\Validator\Person;

use Cartalyst\Support\Validator;
use Firework\Common\Validator\ValidatorTrait;

class PersonValidator extends Validator implements PersonValidatorInterface {

	use ValidatorTrait;

	protected $rules = [
		'name' => 'required',
		'cpf'  => 'required',
		'email' => 'required|unique:people',
	];

	public function onUpdate()
	{
		$this->rules['email'] .= ',email,{email},email';
	}

}
