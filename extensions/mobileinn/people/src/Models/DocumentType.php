<?php namespace Mobileinn\People\Models;

use Residencetech\Apartmentcomplex\Models\Apartmentcomplex;
use Cartalyst\Attributes\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Platform\Attributes\Traits\EntityTrait;
use Cartalyst\Support\Traits\NamespacedEntityTrait;
use Carbon\Carbon;


class DocumentType extends Model implements EntityInterface {

	use EntityTrait, NamespacedEntityTrait;

	/**
	 * {@inheritDoc}
	 */
	protected $table = 'document_types';

	/**
	 * {@inheritDoc}
	 */
	protected $guarded = [
		'id',
		'created_at',
		'updated_at',
	];
}

