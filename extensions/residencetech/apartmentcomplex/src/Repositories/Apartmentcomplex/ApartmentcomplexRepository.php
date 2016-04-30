<?php namespace Residencetech\Apartmentcomplex\Repositories\Apartmentcomplex;

use Firework\Common\Repositories\CrudTrait;
use DB;

class ApartmentcomplexRepository implements ApartmentcomplexRepositoryInterface {

	use CrudTrait;

	public function grid()
	{
		$model = $this->createModel();
		$apartmentComplex = $model->getTable();
		$apartmentComplexType = $model->apartmentType()->getRelated()->getTable();

		return $this->createModel()
			->select(
				$apartmentComplex.'.*',
				$apartmentComplexType.'.type'
				)
			->leftJoin($apartmentComplexType, $apartmentComplexType.'.id', '=', $apartmentComplex.'.apartmenttype_id');
	}

	public function findByQuery($query)
	{
		$model = $this->createModel();
		$apartmentComplex = $model->getTable();

		return DB::table($apartmentComplex)
			->select(DB::raw($apartmentComplex . ".id," . $apartmentComplex . ".name"))
			->where($apartmentComplex . ".name", 'LIKE', '%'.$query.'%')
			->get();
	}
}
