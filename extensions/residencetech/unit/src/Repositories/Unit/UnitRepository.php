<?php namespace Residencetech\Unit\Repositories\Unit;

use Firework\Common\Repositories\CrudTrait;
use DB, Session;

class UnitRepository implements UnitRepositoryInterface {

	use CrudTrait;

	public function grid()
	{
		$model = $this->createModel();
		$unitTable = $model->getTable();
		$ownerTable = $model->owner()->getRelated()->getTable();
		$blockTable = $model->block()->getRelated()->getTable();

		return $this->createModel()
			->select(
				$unitTable.'.*'
			)
			->leftJoin($ownerTable, $ownerTable.'.id', '=', $unitTable.'.owner_id')
			->join($blockTable, function ($join) {

				// Return only units from ApartmentComplex set in current session.
				$apartmentComplexId = Session::get('current_apartmentcomplex.id');

				$join->on('blocks.id', '=', 'units.block_id')
					->where('blocks.apartment_complex_id', '=', $apartmentComplexId);
			});
	}
}
