<?php namespace Residencetech\Unit\Database\Seeds;

use DB;
// use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $faker = Faker::create();

		DB::table('units')->truncate();

		foreach(range(1, 10) as $index)
		{
			// DB::table('units')->insert([
			// 	'name' => $faker->sentence(),
			//	'block_id' => $faker->sentence(),
			//	'owner_id' => $faker->sentence(),
			//	'created_at' => $faker->dateTime(),
			//	'updated_at' => $faker->dateTime(),
			// ]);
		}
	}

}
