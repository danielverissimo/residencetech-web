<?php

use Illuminate\Database\Seeder;
use Firework\Common\Seeder\CsvTrait;

class ApartmenttypesTableSeeder extends Seeder {

	use CsvTrait;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$apartmenttypeRepository = App::make('Residencetech\Apartmenttype\Repositories\Apartmenttype\ApartmenttypeRepositoryInterface');

		$header = ['type'];
		$data = $this->parseCsv(__DIR__.'/data/apartmenttypes.csv', $header);

		$this->seed($data, $apartmenttypeRepository);
	}
}
