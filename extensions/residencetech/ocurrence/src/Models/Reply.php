<?php namespace Residencetech\Ocurrence\Models;

use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;
use Carbon\Carbon;

class Reply extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	protected $table = 'ocurrence_reply';

	protected $guarded = [
		'id',
	];

	protected $dates = ['created_at', 'updated_at'];

	protected $appends = array('personName');

	protected static $entityNamespace = 'residencetech/ocurrence.reply';

	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
	}

	public function person()
	{
		return $this->belongsTo('Mobileinn\People\Models\Person');
	}

	public function getPersonNameAttribute()
	{
		return $this->person->name;
	}

}
