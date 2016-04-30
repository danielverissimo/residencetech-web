<?php namespace Residencetech\Apartmentcomplex\Models;

use Carbon\Carbon;
use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class Apartmentcomplex extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	protected $table = 'apartmentcomplexes';

	protected $guarded = [
		'id',
	];

	protected static $entityNamespace = 'residencetech/apartmentcomplex.apartmentcomplex';

	public function apartmentType()
	{
		return $this->belongsTo('Residencetech\Apartmenttype\Models\Apartmenttype', 'apartmenttype_id', 'id');
	}

	public function people()
	{
		return $this->belongsToMany('Mobileinn\People\Models\Person');
	}

	public function block()
	{
		return $this->belongsToMany('Residencetech\Block\Models\Block');
	}

	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
	}
}
