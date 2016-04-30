<?php namespace Residencetech\Apartmentcomplex\Validator\Apartmentcomplex;

use Cartalyst\Support\Validator;
use Firework\Common\Validator\ValidatorTrait;

class ApartmentcomplexValidator extends Validator implements ApartmentcomplexValidatorInterface {

	use ValidatorTrait;

	protected $rules = [
		'name'       => 'required'
	];

}
