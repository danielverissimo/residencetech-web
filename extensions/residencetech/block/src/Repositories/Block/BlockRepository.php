<?php namespace Residencetech\Block\Repositories\Block;

use Firework\Common\Repositories\CrudTrait;
use DB, Session;

class BlockRepository implements BlockRepositoryInterface {

	use CrudTrait;

	public function findAllByApartmentComplex($apartmentComplexId = null){

		$block = $this->createModel()->getTable();

		return $this->createModel()
			->newQuery()
			->select($block.'.*')
			->where('apartment_complex_id','=', $apartmentComplexId)
			->orderBy('name', 'ASC')
			->get();
	}

	public function grid()
	{
		$model = $this->createModel();
		$blockTable = $model->getTable();
		$apartmentComplex = $model->apartmentComplex()->getRelated()->getTable();

		return $this->createModel()
			->select(
				$blockTable.'.*'
			)
			->join($apartmentComplex, function ($join) {

				// Return only blocks from ApartmentComplex set in current session.
				$apartmentComplexId = Session::get('current_apartmentcomplex.id');

				$join->on('apartmentcomplexes.id', '=', 'blocks.apartment_complex_id')
					->where('apartmentcomplexes.id', '=', $apartmentComplexId);
			});
	}
}
