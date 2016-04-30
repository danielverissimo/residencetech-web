<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people_addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('person_id')->unsigned();
			$table->string('street');
			$table->string('number');
			$table->string('complement');
			$table->string('neighborhood');
			$table->string('zipcode');
			$table->integer('country_id');
			$table->integer('state_id');
			$table->integer('city_id');
			$table->timestamps();

			// foreigns
			$table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('people_addresses');
	}

}
