<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentcomplexesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apartmentcomplexes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable()->unique();
			$table->text('description');
			$table->unsignedInteger('apartmenttype_id');
			$table->timestamps();

			$table->foreign('apartmenttype_id')->references('id')->on('apartmenttypes');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apartmentcomplexes');
	}

}
