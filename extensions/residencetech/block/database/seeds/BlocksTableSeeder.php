<?php

use Illuminate\Database\Seeder;
use Firework\Common\Seeder\CsvTrait;

class BlocksTableSeeder extends Seeder {

	use CsvTrait;

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$blockRepository = App::make('Residencetech\Block\Repositories\Block\BlockRepositoryInterface');

		$header = ['name', 'apartment_complex_id'];
		$data = $this->parseCsv(__DIR__.'/data/blocks.csv', $header);

		$this->seed($data, $blockRepository);
	}
}
