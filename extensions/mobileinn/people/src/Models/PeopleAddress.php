<?php namespace Mobileinn\People\Models;

use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class PeopleAddress extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	protected $table = 'people_addresses';

	protected $guarded = [
		'id',
	];

	protected static $entityNamespace = 'mobileinn/people.address';

	public function person()
	{
		return $this->belongsTo('Mobileinn\People\Models\Person');
	}

	public function country()
	{
		return $this->belongsTo('Firework\Locations\Models\Country');
	}

	public function state()
	{
		return $this->belongsTo('Firework\Locations\Models\State');
	}

	public function city()
	{
		return $this->belongsTo('Firework\Locations\Models\City');
	}

}
