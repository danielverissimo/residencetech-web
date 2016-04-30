<?php namespace Residencetech\Block\Models;

use Carbon\Carbon;
use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;

class Block extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	protected $table = 'blocks';

	protected $guarded = [
		'id',
	];

	protected static $entityNamespace = 'residencetech/block.block';

	public function apartmentComplex()
	{
		return $this->belongsTo('Residencetech\Apartmentcomplex\Models\Apartmentcomplex', 'apartment_complex_id', 'id');
	}

	public function unit()
	{
		return $this->hasMany('Residencetech\Unit\Models\Unit');
	}

	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
	}
}
