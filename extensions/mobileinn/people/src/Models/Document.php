<?php namespace Mobileinn\People\Models;

use Residencetech\Apartmentcomplex\Models\Apartmentcomplex;
use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;
use Carbon\Carbon;

class Document extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait, DateTrait;

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'document_person';

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
	];

	public function person()
	{
		return $this->belongsTo('Mobileinn\People\Models\Person');
	}

	public function documentType()
	{
		return $this->belongsTo('Mobileinn\People\Models\DocumentType');
	}
}


