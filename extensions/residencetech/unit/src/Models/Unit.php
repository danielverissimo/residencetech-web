<?php namespace Residencetech\Unit\Models;

use Carbon\Carbon;
use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class Unit extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	protected $table = 'units';

	protected $guarded = [
		'id',
		'owner_name',
	];

	protected static $entityNamespace = 'residencetech/unit.unit';

	public function owner()
	{
		return $this->belongsTo('Mobileinn\People\Models\Person', 'owner_id', 'id');
	}

	public function block()
	{
		return $this->belongsTo('Residencetech\Block\Models\Block');
	}

	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
	}
}
