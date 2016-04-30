<?php namespace Mobileinn\People\Models;

use Residencetech\Apartmentcomplex\Models\Apartmentcomplex;
use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;
use Carbon\Carbon;


class Person extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	protected $table = 'people';

	protected $dates = ['birthdate'];

	protected $guarded = [
		'id',
		'address',
		'apartmentComplexes',
		'apartment_complexes',
		'permissions',
		'password_confirmation',
		'password',
		'roles',
	];

	protected static $entityNamespace = 'mobileinn/people.person';

	public function address()
	{
		return $this->hasOne('Mobileinn\People\Models\PeopleAddress');
	}

	public function user()
	{
		return $this->belongsTo('Platform\Users\Models\User');
	}

	public function apartmentComplexes()
	{
		return $this->belongsToMany('Residencetech\Apartmentcomplex\Models\Apartmentcomplex');
	}

	public function documents()
	{
		return $this->hasMany('Mobileinn\People\Models\Document');
	}

	public function unit()
	{
		return $this->hasMany('Residencetech\Unit\Models\Unit');
	}

	public function setBirthdateAttribute($value)
	{
		$this->attributes['birthdate'] = Carbon::createFromFormat('d/m/Y', $value);
	}
}
