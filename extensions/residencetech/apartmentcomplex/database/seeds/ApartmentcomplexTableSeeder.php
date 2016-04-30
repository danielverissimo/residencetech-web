<?php

use Illuminate\Database\Seeder;
use Firework\Common\Seeder\CsvTrait;

class ApartmentcomplexTableSeeder extends Seeder {

	use CsvTrait;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$apartmentcomplexRepository = App::make('Residencetech\Apartmentcomplex\Repositories\Apartmentcomplex\ApartmentcomplexRepositoryInterface');

		$header = ['name', 'description', 'apartmenttype_id'];
		$data = $this->parseCsv(__DIR__.'/data/apartmentcomplexes.csv', $header);

		$this->seed($data, $apartmentcomplexRepository);
	}
}
