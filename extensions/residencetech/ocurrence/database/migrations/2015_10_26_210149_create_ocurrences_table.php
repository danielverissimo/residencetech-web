<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcurrencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ocurrences', function(Blueprint $table)
		{
			$table->increments('id');
			$table->longText('data');
			$table->integer('person_id')->unsigned()->nullable();
			$table->integer('apartment_complex_id')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ocurrences');
	}

}
